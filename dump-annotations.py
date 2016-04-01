import subprocess
import os
import sys
import glob
import json
import shutil


annoDir = '/scail/scratch/u/syyeung/fga/data/thumos/annotations'
vidDir = '/scail/scratch/u/syyeung/fga/data/thumos/videos'
pubVidDir = '/home/syyeung/vatic/temporal/public/vis/videos'
vidAnnoDir = '/home/syyeung/vatic/temporal/public/vis/annotations'
hitsDir = '/home/syyeung/vatic/temporal/public/hits'

if not os.path.exists(annoDir):
	os.makedirs(annoDir)
if not os.path.exists(vidAnnoDir):
	os.makedirs(vidAnnoDir)

vidSets = [{'type':'validation', 'ids':range(931,941)}, {'type':'test', 'ids': [26,39,374,423,756,1168,1389,1522,1531]}]
worker = 0
vidFps = 30;

listCmd = 'turkic list'
vidList = subprocess.check_output(listCmd, shell=True)
vidList = vidList.strip().split('\n')
vidList = [x.strip() for x in vidList]
vidList = [x for x in vidList if int(x.split('_')[4])==worker]

swingFile = '/home/syyeung/vatic/temporal/public/vis/annotations/TennisSwing_all.txt'
swingAnnos = {}
with open(swingFile) as f:
	swingData = f.read().strip().split('\n')
for line in swingData:
	lineItems = line.split(' ')
	vidName = lineItems[0]
	annoStart = lineItems[2]
	annoEnd = lineItems[3]

	if not vidName in swingAnnos:
		swingAnnos[vidName] = []
	swingAnnos[vidName].append((annoStart,annoEnd))

badLabels = ['TennisBounceBall', 'TennisGesturing', 'TennisTalking']
labelHitsFiles = sorted(glob.glob(hitsDir + '/*.html'))
labelNames = [os.path.splitext(os.path.split(x)[1])[0] for x in labelHitsFiles]
labelNames = [x for x in labelNames if x not in badLabels]

allAnnosFile = '%s/all_annos.json' %(vidAnnoDir)
allAnnos = {}

for vidSet in vidSets:
	vidType = vidSet['type']
	vidIds = vidSet['ids']
	for vidId in vidIds:

		origVidName = 'video_%s_%07d' %(vidType,vidId)
		annoFile = '%s/%s.json' %(vidAnnoDir, origVidName)
		print 'processing %s' %(origVidName)

		origVidFile = '%s/%s/%s.mp4' %(vidDir, vidType, origVidName)
		newVidFile = '%s/%s.mp4' %(pubVidDir, origVidName)
		# shutil.copyfile(origVidFile, newVidFile)
		# continue

		annos = {}
		for labelName in labelNames:
			vidName = '%s_%s_%02d' %(labelName, origVidName, worker)
			dumpCmd = 'turkic dump %s' %(vidName)
			vidData = subprocess.check_output(dumpCmd, shell=True)    
			vidData = vidData.strip()
			if len(vidData) == 0:
				continue
			vidData = vidData.split('\n')
			labelFrames = [int(x.split(' ')[5]) for x in vidData]

			annoRanges = []
			annoStart = labelFrames[0]
			annoEnd = -1
			for frameIter in range(1, len(labelFrames)):
				if (labelFrames[frameIter] - labelFrames[frameIter-1]) > 1:
					annoEnd = labelFrames[frameIter-1]
					annoRanges.append((annoStart,annoEnd))
					annoStart = labelFrames[frameIter]
			annoEnd = labelFrames[-1]
			annoRanges.append((annoStart,annoEnd))

			annoRangesSecs = [(round(x/float(vidFps),2), round(y/float(vidFps),2)) for (x,y) in annoRanges]	
			annos[labelName] = annoRangesSecs

		annos['TennisSwing'] = swingAnnos[origVidName]

		allAnnos[origVidName] = annos
		#print allAnnos
		
		# with open(annoFile, 'w') as af:
		# 	json.dump(annos, af, indent=4)

# with open(allAnnosFile, 'w') as af:
# 	json.dump(allAnnos, af, indent=4)


# for labelName in labelNames:
# 	for vidSet in vidSets:
# 		setType = vidSet['type']

# 		print 'processing %s, %s' %(labelName, setType)

# 		annoFile = '%s/%s_%s.txt' %(annoDir, labelName, setType)
# 		af = open(annoFile, 'w')
# 		for vidName in vidList:
# 			vidItems = vidName.split('_')
# 			vidLabel = vidItems[0]
# 			vidType = vidItems[2]
# 			vidId = vidItems[3]
# 			origVidName = 'video_%s_%s' %(setType, vidId)
# 			if (vidLabel != labelName) or (vidType != setType):
# 				continue
# 			#print vidName

# 			dumpCmd = 'turkic dump %s' %(vidName)
# 			vidData = subprocess.check_output(dumpCmd, shell=True)    
# 			vidData = vidData.strip()
# 			if len(vidData) == 0:
# 				continue
# 			vidData = vidData.split('\n')
# 			labelFrames = [int(x.split(' ')[5]) for x in vidData]

# 			annoRanges = []
# 			annoStart = labelFrames[0]
# 			annoEnd = -1
# 			for frameIter in range(1, len(labelFrames)):
# 				if (labelFrames[frameIter] - labelFrames[frameIter-1]) > 1:
# 					annoEnd = labelFrames[frameIter-1]
# 					annoRanges.append((annoStart,annoEnd))
# 					annoStart = labelFrames[frameIter]
# 			annoEnd = labelFrames[-1]
# 			annoRanges.append((annoStart,annoEnd))

# 			annoRangesSecs = [(x/float(vidFps), y/float(vidFps)) for (x,y) in annoRanges]
# 			for annoRange in annoRangesSecs:
# 				annoOutput = '%s  %.1f %.1f\n' %(origVidName, annoRange[0], annoRange[1])
# 				af.write(annoOutput)
# 			# print labelFrames
# 			# print annoRanges
# 			# print annoRangesSecs
# 		af.close()





