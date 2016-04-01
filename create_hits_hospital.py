import subprocess
import os
import sys
import glob
from jinja2 import Environment, FileSystemLoader

frameRootDir = '/scail/data/group/vision/u/syyeung/hospital/data'
vidSets = [{'date': 17, 'dir': 'cvpr10-17-15afternoon', 'hits': [], 'ids': [], 'names': []}, {'date': 18, 'dir': 'cvpr10-18-15morning', 'hits': [], 'ids': [], 'names': []}, {'date': 19, 'dir': 'cvpr10-19-15morning', 'hits': [], 'ids': [], 'names': []}, {'date': 20, 'dir': 'cvpr10-20-15morning', 'hits': [], 'ids': [], 'names': []}]
masterHitsFile = '/home/syyeung/vatic/vatic/public/hits_hygiene.php'
hitsDir = '/home/syyeung/vatic/vatic/public/hits_hygiene';
wrapperDir = '/home/syyeung/vatic/vatic/public/wrapper'

labelName = "HospitalHygiene"
vidFps = 10;
vidLen = vidFps * 20;
# vidTypes = {'rgb', 'd', 'fs'}
vidTypes = {'rgb'}

generateHits = True;

oldHitsFile = '/home/syyeung/vatic/vatic/old-hits.txt'
with open(oldHitsFile) as f:
  oldHits = f.read().strip().split('\n')

existingHits = oldHits
id = 0

if generateHits:
  for vidType in vidTypes:
    for video in vidSets:
      indexVid = 0
      frameSetDir = video['dir']  
      frameDate = video['date']
      vidName = '%s_video_%s_%d_%d' %(labelName, vidType, frameDate, indexVid)
      framesDir = '%s/%s/frame_%s' %(frameRootDir, frameSetDir, vidType)
      
      # upload all videos (i.e. rgb, d, fg) 
      loadVidCmd = 'turkic load %s %s %s --offline --length %d --blow-radius 0 --overlap 0' %(vidName, framesDir, labelName, vidLen)
      print loadVidCmd
      subprocess.check_call(loadVidCmd, shell=True)
      publishCmd = 'turkic publish --offline'
      hitsData = subprocess.check_output(publishCmd, shell=True)

      hits = hitsData.strip().split('\n')
      newHits = set(hits) - set(existingHits)
      newHits = sorted(newHits)
      print vidType
      print newHits
 
      # only save rgb video information
      if vidType == 'rgb':
        video['hits'] = newHits
        hitsFile = '%s/%s.hits' % (hitsDir, vidName)
        f = open(hitsFile, 'a')
	index = 0
        for hit in video['hits']:
          f.write(hit + '\n')
          name = '%s_%d' %(vidName, index)
          video['names'].append(name)
          video['ids'].append(id)
          id += 1
          index += 1

        f.close()
      indexVid += 1
  
      print video['names']
      print video['ids'] # used as page id later

      existingHits += sorted(newHits)

#write old hits file
f = open(oldHitsFile, 'w')
for hit in existingHits:
  f.write(hit + '\n')
f.close()

#write label hits html
PATH = os.path.dirname(os.path.abspath(__file__))
env = Environment(loader = FileSystemLoader(PATH))

#write wrap label hits html
vidWrapperTemplate = env.get_template('/public/wrapper/videoWrapperTemplate.php')
context = {'vidSets': vidSets}
wrapperFile = '%s/%s_wrapper.php' %(wrapperDir, labelName)
with open(wrapperFile, 'w') as f:
  html = vidWrapperTemplate.render(context)
  f.write(html)

#write a wrapper html for each video -- NOT USED!
'''
wrapperTemplate = env.get_template('/public/wrapper/wrapperTemplate.php')
for video in vidSets:
  i = 0
  names = video['names']
  ids = video['ids']
  for hit in video['hits']:
    name = names[i]
    id = ids[i]
    context = {'hit': hit, 'id': id}
    vidWrapperFile = '%s/%s.php' %(wrapperDir, name)
    with open(vidWrapperFile, 'w') as f:
      html = wrapperTemplate.render(context)
      f.write(html)
    i += 1
'''

#regenerate master hits html
masterHitsTemplate = env.get_template('/public/masterHitsTemplate_hygiene.php')

labelHitsFiles = sorted(glob.glob(hitsDir + '/*.html'))
labelNames = [];
for labelHitsFile in labelHitsFiles:
  path, fileName = os.path.split(labelHitsFile)
  labelName = os.path.splitext(fileName)[0]
  labelNames.append(labelName)

#context = { 'labelNames': labelNames }
context = {'labelNames': [labelName]} 

with open(masterHitsFile, 'w') as f:
  html = masterHitsTemplate.render(context)
  f.write(html)

