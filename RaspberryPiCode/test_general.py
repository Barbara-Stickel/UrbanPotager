# -*- coding: utf-8 -*-
#!/usr/bin/python

import time
import RPi.GPIO as GPIO
import grove_rgb_lcd as LCD
from grovepi import *
import MySQLdb
import base_donnee


#pompe
pompe = 4
ultrasonic_ranger = 4

# configuration pin
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

GPIO.setup(pompe, GPIO.OUT)
GPIO.output(pompe, 0)


temps_arrosage = 2
temps_de_cycle = 5

niveau_eau_min = 15

#led

# luminosité voulue pour les plantes
luminosite_voulue_min = 600
luminosite_voulue_max = 675

# configuration du capteur de lumière
light_sensor = 0
pinMode(light_sensor,"INPUT")

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
  print("Verification de l'arrosage")
  print("La pompe d'eau doit s'allumer pendant 3s, puis s'éteindre 5s et se rallumer 5s")
  GPIO.output(pompe, 1)
  time.sleep(temps_arrosage)
  GPIO.output(pompe, 0)
  time.sleep(temps_de_cycle)
  GPIO.output(pompe, 1)
  time.sleep(temps_arrosage)
  GPIO.output(pompe, 0)
  time.sleep(temps_de_cycle)

  print("Verification de la luminosité")
  print("La lumière doit s'allumer progressivement puis s'éteindre")
  GPIO.output(led, 1)
  GPIO.output(palier1, 0)
  GPIO.output(palier2, 0)
  GPIO.output(palier3, 0)

  time.sleep(2)
  GPIO.output(palier1, 1)

  time.sleep(2)
  GPIO.output(palier2, 1)

  time.sleep(2)
  GPIO.output(palier3, 1)

  time.sleep(2)
  GPIO.output(palier3, 0)

  time.sleep(2)
  GPIO.output(palier2, 0)

  time.sleep(2)
  GPIO.output(palier1, 0)

  time.sleep(2)
  GPIO.output(led, 0)

  print("Verification du capteur de hauteur d'eau")

  i = 0
  while (i<10):
    distant = ultrasonicRead(ultrasonic_ranger)
    niveau_eau = 28.5 - distant
    print 'distance ', distant,'cm'
    print "niveau d'eau ", niveau_eau, 'cm'
    i+=1
    time.sleep(2)
