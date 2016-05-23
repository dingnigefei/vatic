import json
import argparse

def main(**kwargs):
  data_root = kwargs.get('data_root')
  vatic_root = kwargs.get('vatic_root')
  server = kwargs.get('server')
  create_config_json(data_root, vatic_root, server)

def create_config_json(data_root, vatic_root, server):
  config = {}
  config['data_root'] = data_root
  config['vatic_root'] = vatic_root
  config['server'] = server
  with open('config.json', 'w') as fp:
      json.dump(config, fp)

if __name__ == "__main__":
  parser = argparse.ArgumentParser()
  parser.add_argument('-data_root', nargs='?', default='/home/cvpr_data/', type=str)
  parser.add_argument('-vatic_root', nargs='?', default='/home/bpeng/vatic_root/', type=str)
  parser.add_argument('-server', nargs='?', default='10.234.26.35', type=str)
  args = parser.parse_args()
  main(**vars(args))
