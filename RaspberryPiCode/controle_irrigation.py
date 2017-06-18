# -*- coding: utf-8 -*-
#!/usr/bin/python

import time
import RPi.GPIO as GPIO
import grove_rgb_lcd as LCD
from grovepi import *
import MySQLdb
import base_donnee


pompe = 4
ultrasonic_ranger = 4

nbre_arrosage_par_jour = base_donnee.nbre_arrosage_par_jour
temps_arrosage = 5
temps_de_cycle = (24*3600/nbre_arrosage_par_jour - temps_arrosage)

temps_de_cycle_test  = 50
temps_niveau_eau_trop_faible = 3

# niveau d'eau min nécessaire pour que la pompe puisse fonctionner correctement
niveau_eau_min = 2.5


# configuration pin
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

GPIO.setup(pompe, GPIO.OUT)
GPIO.output(pompe, 0)

while True:
    try:
        distant = ultrasonicRead(ultrasonic_ranger)
        niveau_eau = 28.5 - distant
        
        # cas où le niveau d'eau est suffisant
        if (niveau_eau > niveau_eau_min):
            GPIO.output(pompe, 1)
            time.sleep(temps_arrosage)
            GPIO.output(pompe, 0)
            time.sleep(temps_de_cycle)

        # cas où il manque de l'eau
        else:
            LCD.setRGB(200,0,0)
            LCD.setText("Niveau d'eau trop faible!")
            time.sleep(temps_niveau_eau_trop_faible)
            
    except (IOError, TypeError) as e:
        print("Error")


