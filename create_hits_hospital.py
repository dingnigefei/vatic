import subprocess
import os
import sys
import glob
from jinja2 import Environment, FileSystemLoader

frameRootDir = '/home/cvpr_data/'
stations = [s for s in os.listdir(frameRootDir) if s.find('10') != -1 and \
            os.path.isdir(frameRootDir+s+'/frame_d')]
stations.sort()

vidSets = []
for s in stations:
    vidSets.append({'station': s, 'dir': s, 'hits': [], 'ids': [], 'names': []})

print vidSets

masterHitsFile = '/home/bpeng/vatic_root/vatic/public/hits_hygiene.php'
hitsDir = '/home/bpeng/vatic_root/vatic/public/hits_hygiene';
wrapperDir = '/home/bpeng/vatic_root/vatic/public/wrapper'

labelName = "HospitalHygiene"
vidFps = 5;
vidLen = vidFps * 200;
vidTypes = {'d'}

generateHits = True;

oldHitsFile = '/home/bpeng/vatic_root/vatic/old-hits.txt'
with open(oldHitsFile) as f:
  oldHits = f.read().strip().split('\n')

existingHits = oldHits
id = 0
offset = '0'

if generateHits:
  for vidType in vidTypes:
    for video in vidSets:
      indexVid = 0
      frameSetDir = video['dir']
      frameDate = video['station']
      vidName = '%s_video_%s_%s_%d' %(labelName, vidType, frameDate, indexVid)
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

      # find video id offset
      if id == 0:
        url = newHits[0]
        offset = url.split('&')[0].split('=')[1]
        print '##############################'
        print offset
        print '##############################'

      # only save depth video information
      if vidType == 'd':
        video['hits'] = newHits
        hitsFile = '%s/%s.hits' % (hitsDir, vidName)
        f = open(hitsFile, 'a')
        index = 0
        for hit in video['hits']:
          f.write(hit + '\n')
          #   name = '%s_%d' %(vidName, index)
          name = '%s_%d' %(vidName, id)
          video['names'].append(name)
          video['ids'].append(id)
          id += 1
          index += 1

        f.close()
      indexVid += 1

      video['ids'].sort()
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
context = {'vidSets': vidSets, 'offset': offset}
wrapperFile = '%s/%s_wrapper.php' %(wrapperDir, labelName)
with open(wrapperFile, 'w') as f:
  html = vidWrapperTemplate.render(context)
  f.write(html)

#regenerate master hits html
masterHitsTemplate = env.get_template('/public/masterHitsTemplate_hygiene.php')

labelHitsFiles = sorted(glob.glob(hitsDir + '/*.html'))
labelNames = [];
for labelHitsFile in labelHitsFiles:
  path, fileName = os.path.split(labelHitsFile)
  labelName = os.path.splitext(fileName)[0]
  labelNames.append(labelName)

context = {'labelNames': [labelName]}

with open(masterHitsFile, 'w') as f:
  html = masterHitsTemplate.render(context)
  f.write(html)
