SAVEDIR=/home/pi/urban_potager/timelapse/
while [ true ]; do
filename=-$(date -u + "%d%m%Y_%H%M-%S").jpg
/opt/vc/bin/raspistill -o $SAVEDIR/$filename
sleep 4;
done;
