import subprocess
import os
import sys
import glob
from jinja2 import Environment, FileSystemLoader

#frameSet = {'/scail/data/group/vision/u/syyeung/hospital/data/train', '/scail/data/group/vision/u/syyeung/hospital/data/cvpr10-17-15afternoon'}
frameSet = {'/scail/data/group/vision/u/syyeung/hospital/data/cvpr10-19-15morning'}
# framesRootDir = '/scail/data/group/vision/u/syyeung/hospital/data/train';
masterHitsFile = '/home/syyeung/vatic/vatic/public/hits_hygiene.php'
hitsDir = '/home/syyeung/vatic/vatic/public/hits_hygiene';
wrapperDir = '/home/syyeung/vatic/vatic/public/wrapper'

labelName = "HospitalHygiene"
vidFps = 10;
vidLen = vidFps * 20;
vidSets = [{'type': 'rgb', 'hits': [], 'names': [], 'ids': []}, {'type': 'fs', 'hits': [], 'names': [], 'ids': []}, {'type': 'd', 'hits': [], 'names': [], 'ids': []}]

# vidSets = [{'type': 'd', 'hits': [], 'names': [], 'ids': []}]

generateHits = True;

oldHitsFile = '/home/syyeung/vatic/vatic/old-hits.txt'
with open(oldHitsFile) as f:
  oldHits = f.read().strip().split('\n')

existingHits = oldHits
id = 0

if generateHits:
  for video in vidSets:
    vidType = video['type']
    indexDir = 0
    for framesRootDir in frameSet:  
      vidName = '%s_video_%s_%d' %(labelName, vidType, indexDir)
      framesDir = '%s/frame_%s' %(framesRootDir, vidType)
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
 
      video['hits'] = newHits
      hitsFile = '%s/%s.hits' % (hitsDir, vidName)
      f = open(hitsFile, 'a')
      for hit in video['hits']:
        f.write(hit + '\n')
      f.close()
      indexDir += 1
  
    index = 0
    for hit in video['hits']:
      name = '%s_%d' %(vidName, index)
      video['names'].append(name)
      video['ids'].append(id)
      id += 1
      index += 1
      
    print video['names']
    print video['ids']

    existingHits = sorted(hits)

#write old hits file
f = open(oldHitsFile, 'w')
for hit in existingHits:
  f.write(hit + '\n')
f.close()

#write label hits html
PATH = os.path.dirname(os.path.abspath(__file__))
env = Environment(loader = FileSystemLoader(PATH))

'''
labelHitsTemplate = env.get_template('/public/labelHitsTemplate_hygiene.html')

context = {'vidSets': vidSets}
labelHitsFile = '%s/%s.html' %(hitsDir, labelName)
with open(labelHitsFile, 'w') as f:
  html = labelHitsTemplate.render(context)
  f.write(html)
'''

#write wrap label hits html
vidWrapperTemplate = env.get_template('/public/wrapper/videoWrapperTemplate.html')
context = {'vidSets': vidSets}
wrapperFile = '%s/%s_wrapper.html' %(wrapperDir, labelName)
with open(wrapperFile, 'w') as f:
  html = vidWrapperTemplate.render(context)
  f.write(html)

#write a wrapper html for each video
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

