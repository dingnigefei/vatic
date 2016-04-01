import subprocess
import os
import sys
import glob
from jinja2 import Environment, FileSystemLoader

framesRootDir = '/scail/scratch/u/syyeung/fga/data/thumos/frames_vatic'

labelName = 'TennisExtendRacket'
vidFps = 30;
vidLen = vidFps*30;
numWorkers = 3;

vidSets = [{'type': 'validation', 'ids': range(931,941)}, {'type': 'test', 'ids': [26,39,374,423,756,1168,1389,1522,1531]}]

for vidSet in vidSets:
  vidType = vidSet['type']
  vidIds = vidSet['ids']
  for vidId in vidIds:
    for worker in range(numWorkers):
      vidName = '%s_video_%s_%07d_%02d' %(labelName, vidType, vidId, worker)
      framesDir = '%s/%s/video_%s_%07d' %(framesRootDir, vidType, vidType, vidId)
      deleteVidCmd = 'turkic delete %s --force' %(vidName)
      subprocess.check_call(deleteVidCmd, shell=True)
