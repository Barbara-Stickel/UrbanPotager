# -*- coding: utf-8 -*-

from grovepi import *
from grove_rgb_lcd import *
import time

dht_sensor_port = 7     # Connect the DHt sensor to port 7
dht_sensor_type = 0     # change this depending on your sensor type - see header comment

light_sensor = 0
pinMode(light_sensor, "INPUT")


while True:

    [ temp,hum ] = dht(dht_sensor_port,dht_sensor_type)     #Get the temperature and Humidity from the DHT sensor
    sensor_value = analogRead(light_sensor)
 
    t = str(temp)
    h = str(hum)
    s = str(sensor_value)

    # appelle le programme qui est dans Desktop/GrovePi/Project/Home_weather
    setRGB(50,150,50) #ne fait que changer la couleur

    # affichage de la température et de l'humidité
    setText("Temp:" + t + "C      " + "Humidite:" + h + "%")
    time.sleep(5)

    # affichage de la température et de la luminosité
    setRGB(50,200,100)
    setText("Temp:" + t + "C      " + "Luminosite:" + s + " L")
    time.sleep(5)


