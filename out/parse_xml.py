import numpy as np
import os
from xml.dom.minidom import parse

LENGTH = 1000

def parse_object_xml(xml_path):
    # Open XML document using minidom parser
    DOMTree = parse(xml_path)
    table = DOMTree.documentElement
    data = {}

    rows = table.getElementsByTagName('row')
    for row in rows:
        fields = row.getElementsByTagName('field')
        video_id = fields[0].childNodes[0].data
        # label_name = fields[1].childNodes[0].data
        labels = fields[2].childNodes[0].data
        labels = np.array(labels[1:-1].split('&quot;'))
        print labels
    return data

def parse_frame_xml(xml_path):
    # Open XML document using minidom parser
    DOMTree = parse(xml_path)
    table = DOMTree.documentElement
    data = {}

    rows = table.getElementsByTagName('row')
    for row in rows:
        fields = row.getElementsByTagName('field')
        video_id = fields[0].childNodes[0].data
        label_name = fields[1].childNodes[0].data
        labels = fields[2].childNodes[0].data
        labels = np.array(labels[1:-1].split(','), dtype=int)
        if (len(labels) > LENGTH):
            labels = labels[:LENGTH] # Drop overlapping frames at the end
        data[int(video_id)] = labels
    return data

def main():
    frame_xml_path = 'frame_label.xml'
    frame_data = parse_frame_xml(frame_xml_path)
    print (frame_data.values()[0]).shape
    print (frame_data.values()[1]).shape

    object_xml_path = 'object_label.xml'
    object_data = parse_object_xml(object_xml_path)
    # print (object_data.values()[0]).shape
    # print (frame_data.values()[1]).shape

if __name__ == "__main__":
    main()
