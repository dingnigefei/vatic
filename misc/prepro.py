import subprocess
import os

def main():
  root_dir = '/home/cvpr_data/'
  stations = [d for d in os.listdir(root_dir) if d.find('10') != -1 and \
              os.path.isdir(root_dir+d+'/d')]
  print '#######################'
  print 'Availabel stations:'
  for s in stations:
    print s
    subprocess.call('./convert_to_vatic.sh ' + root_dir + s, shell=True)

if __name__ == "__main__":
  main()
