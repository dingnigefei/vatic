import subprocess
import os
import sys
import glob
from jinja2 import Environment, FileSystemLoader

framesRootDir = '/scail/scratch/u/syyeung/fga/data/thumos/frames_vatic'

masterHitsFile = '/home/syyeung/vatic/vatic/public/hits.php'
hitsDir = '/home/syyeung/vatic/vatic/public/hits'

labelName = 'TennisExtendRacket'
vidFps = 30;
vidLen = vidFps*30;
numWorkers = 3;  
generateHits = True

vidSets = [{'type': 'validation', 'ids': range(931,941)}, {'type': 'test', 'ids': [26,39,374,423,756,1168,1389,1522,1531]}]

oldHitsFile = '/home/syyeung/vatic/vatic/old-hits.txt'
with open(oldHitsFile) as f:
	oldHits = f.read().strip().split('\n')

existingHits = oldHits

#print oldHits
#sys.exit()

if generateHits:
	for vidSet in vidSets:
		vidType = vidSet['type']
		vidIds = vidSet['ids']
		for vidId in vidIds:
			for worker in range(numWorkers):
				vidName = '%s_video_%s_%07d_%02d' %(labelName, vidType, vidId, worker)
				framesDir = '%s/%s/video_%s_%07d' %(framesRootDir, vidType, vidType, vidId)
				#print vidName

				#deleteVidCmd = 'turkic delete %s' %(vidName)
				#subprocess.check_call(deleteVidCmd, shell=True)

				loadVidCmd = 'turkic load %s %s %s --offline --length %d --blow-radius 0' %(vidName, framesDir, labelName, vidLen)
				subprocess.check_call(loadVidCmd, shell=True)

				publishCmd = 'turkic publish --offline'
				hitsData = subprocess.check_output(publishCmd, shell=True)				
				hits = hitsData.strip().split('\n')
		
				newHits = set(hits) - set(existingHits)
				newHits = sorted(newHits)

				hitsFile = '%s/%s.hits' % (hitsDir, vidName)
				f = open(hitsFile, 'a')
				for hit in newHits:
					f.write(hit + '\n')
				f.close()

				existingHits = sorted(hits)

#write old hits file
f = open(oldHitsFile, 'w')
for hit in existingHits:
	f.write(hit + '\n')
f.close()

#write label hits html
PATH = os.path.dirname(os.path.abspath(__file__))
env = Environment(loader = FileSystemLoader(PATH))
labelHitsTemplate = env.get_template('/public/labelHitsTemplate.html')

vidHitsDict = {}
for vidSet in vidSets:
	vidType = vidSet['type']
	vidIds = vidSet['ids']
	for vidId in vidIds:
		for worker in range(numWorkers):
			vidName = '%s_video_%s_%07d_%02d' % (labelName, vidType, vidId, worker)
			hitsFile = '%s/%s.hits' % (hitsDir, vidName)
			print hitsFile
			with open(hitsFile) as f:
				vidHitsDict[vidName] = f.read().strip().split('\n');

context = {
	'numWorkers': numWorkers,
	'vidSets': vidSets,
	'vidHitsDict': vidHitsDict,
	'labelName': labelName
}

labelHitsFile = '%s/%s.html' %(hitsDir, labelName)
with open(labelHitsFile, 'w') as f:
	html = labelHitsTemplate.render(context)
	f.write(html)

#regenerate master hits html
masterHitsTemplate = env.get_template('/public/masterHitsTemplate.php')

labelHitsFiles = sorted(glob.glob(hitsDir + '/*.html'))
labelNames = [];
for labelHitsFile in labelHitsFiles:
	path, fileName = os.path.split(labelHitsFile)
	labelName = os.path.splitext(fileName)[0]
	if labelName == 'TennisBounceBall':
		continue
	if labelName == 'TennisTalking':
		continue
	if labelName == 'TennisGesturing':
		continue
	labelNames.append(labelName)

context = {
	'labelNames': labelNames
}

with open(masterHitsFile, 'w') as f:
        html = masterHitsTemplate.render(context)
        f.write(html)

