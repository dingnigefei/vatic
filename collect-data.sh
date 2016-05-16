mysql -u root --database=vatic --execute='SELECT `video_id`,`label_name`,`labels` FROM `frame_label`' -X > out/frame_label.xml
mysql -u root --database=vatic --execute='SELECT `video_id`,`label_name`,`labels` FROM `object_label`' -X > out/object_label.xml
