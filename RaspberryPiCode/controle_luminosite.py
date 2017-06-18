# -*- coding: utf-8 -*-
#!/usr/bin/python

import time
import grovepi
import RPi.GPIO as GPIO
import MySQLdb
import base_donnee
import sunset


# luminosité voulue pour les plantes
luminosite_voulue_min = 600
luminosite_voulue_max = 700

# configuration du capteur de lumière
light_sensor = 0
grovepi.pinMode(light_sensor,"INPUT")

# configuration pin
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

# pin pour allumer ou eteindre la LED, on considère que 1 allume la LED (à l'exterieur sur le relay)
led = 18
GPIO.setup(led, GPIO.OUT)
GPIO.output(led, 0)

# pins pour modifier l'intensité de la LED
# quand on les met a 1, on court-circuite la résistance
# par défaut ils sont à zéro donc lorsqu'on allume la lampe elle est au minimum
# de son intensité
palier1 = 25
palier2 = 24
palier3 = 23

GPIO.setup(palier1,GPIO.OUT)
GPIO.output(palier1, 0)

GPIO.setup(palier2,GPIO.OUT)
GPIO.output(palier2, 0)

GPIO.setup(palier3,GPIO.OUT)
GPIO.output(palier3, 0)


while True:
    try:
        # on récupère le début du jour voulu par l'utilisateur
        debut_jour = sunset.debut_jour
        debut_nuit = debut_jour + base_donnee.temps_eclairage
        
        # on récupère l'heure actuelle
        heure, minute = (time.localtime()[3], time.localtime()[4])

        # cas ou il fait nuit
        if (heure > debut_nuit or heure < debut_jour):
            print "cas ou il fait nuit"
            temps_nuit = 24 + debut_jour - heure
            time.sleep(temps_nuit)

        # lever du soleil
        if debut_jour == heure:
            print "lever du soleil"
            # valeur de la luminosité
            sensor_value = grovepi.analogRead(light_sensor)
            
            if (sensor_value < luminosite_voulue_min):

                #on allume petit à petit la lampe
                GPIO.output(led, 1)
                GPIO.output(palier1, 0)
                GPIO.output(palier2, 0)
                GPIO.output(palier3, 0)

                #on attend 15 min
                time.sleep(900)
                GPIO.output(palier1, 1)

                #on attend 15 min
                time.sleep(900)
                GPIO.output(palier2, 1)

                #on attend 15 min
                time.sleep(900)
                GPIO.output(palier3, 1)
                
        # coucher du soleil
        if debut_nuit-1 == heure:

            print "coucher du soleil"
            
            # valeur de la luminosité
            sensor_value = grovepi.analogRead(light_sensor)
            
            #on éteint petit à petit la lampe
            GPIO.output(palier3, 0)

            #on attend 15 min
            time.sleep(900)
            GPIO.output(palier2, 0)
            
            #on attend 15 min
            time.sleep(900)
            GPIO.output(palier1, 0)

            #on attend 15 min
            time.sleep(900)
            GPIO.output(led, 1)
            
            
        # cas ou il fait jour
        else:
            
            # valeur de la luminosité
            sensor_value = grovepi.analogRead(light_sensor)

            # cas où la luminosité est trop faible
            if (sensor_value < luminosite_voulue_min):
                GPIO.output(led, 1)
                sensor_value = grovepi.analogRead(light_sensor)
                
                if (sensor_value < luminosite_voulue_min):
                    GPIO.output(palier1, 1)
                    sensor_value = grovepi.analogRead(light_sensor)
                    
                    if (sensor_value < luminosite_voulue_min):
                        GPIO.output(palier2, 1)
                        sensor_value = grovepi.analogRead(light_sensor)
                        
                        if (sensor_value < luminosite_voulue_min):
                            GPIO.output(palier3, 1)

            # cas où la luminosité est trop forte
            if (sensor_value > luminosite_voulue_max):
                GPIO.output(palier3, 0)
                sensor_value = grovepi.analogRead(light_sensor)
                
                if (sensor_value > luminosite_voulue_max):
                    GPIO.output(palier2, 0)
                    sensor_value = grovepi.analogRead(light_sensor)
                    
                    if (sensor_value > luminosite_voulue_max):
                        GPIO.output(palier1, 0)
                        sensor_value = grovepi.analogRead(light_sensor)
                        
                        if (sensor_value > luminosite_voulue_max):
                            GPIO.output(led, 0)

            time.sleep(3)
            
    except IOError:
        print("error")
                
