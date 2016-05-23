import subprocess
import os

def main():
    video_root_dir = 'public/hits_hygiene/'
    videos = [v for v in os.listdir(video_root_dir) if v.find('.hits') != -1]
    for v in videos:
        v = v.split('.hits')[0]
        print v
        delete_video(v)

def delete_video(video):
    delete_cmd = 'turkic delete %s --force' %(video)
    subprocess.check_call(delete_cmd, shell=True)

if __name__ == "__main__":
    main()
