echo 'reset turkic database' 
sudo turkic setup --database --reset
echo 'remove old-hits.txt'
sudo rm old-hits.txt
touch old-hits.txt
echo 'remove *.hits'
sudo rm public/hits_hygiene/*.hits
