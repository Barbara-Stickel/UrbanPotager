import os
import time

# nombre de photos utilisees totales
nbre_photo = 1000

# nombre de photos par seconde utilisees
npps_in = 1

longueur_du_film = float(nbre_photo/npps_in)

# Compte le nombre de photos prises
compteur_photo = 0

while True:

    try:
        
        # on récupère l'heure actuelle
        heure = time.localtime()[3]
        minute = time.localtime()[4]
        
        if (heure == 16 and minute == 30):
            
            #zfill permet de s'assurer que le numero de la photo aura 7 digit
            numero_photo = str(compteur_photo).zfill(7)

            # Prise de la photo
            os.system("raspistill -o /var/www/live/photo/image_%s.jpg" %numero_photo)

            # Création du Timelapse
            os.system("avconv -r 2 -i /var/www/live/photo/image_%07d.jpg -r 2 -vcodec libx264 -crf 20 -g 15 -vf crop=2592:1458,scale=1280:720 /var/www/live/timelapse_new.avi")
    
            # Chaque jour une nouvelle vidéo est crée. Afin d'éviter de surcharger la
            # mémoire, on efface celle du jour précédent une fois que la nouvelle est
            # crée.
        
            if compteur_photo>0 :
                os.remove('/var/www/live/timelapse_old.avi')

            os.rename("/var/www/live/timelapse_new.avi", "/var/www/live/timelapse_old.avi")

            # Le programme met environ 3h pour faire un timelapse de 1000 photos, il faut
            # à un moment donné effacer des photos. A partir du moment où il y a trop
            # de photos, on en efface 1 sur 3 et on ajoute au nombre de photos voulues
            # le nombree de photos enlevées.
            # On commence i à 1 pour que la première photo soit toujours présente.

            liste = os.listdir("/var/www/live/photo")
            liste.sort(key = lambda x:int(x[6:10]))
            
            if len(liste) > nbre_photo:
                
                #permer de balayer toutes les photos
                i=1
                
                while i<nbre_photo:

                    #On efface une photo sur quatre
                    if i%4 == 0:
                        photo_enleve = liste[i]
                        os.remove('/var/www/live/photo/{}'.format(photo_enleve))
                    i+=1
                    
            compteur_photo +=1

            #On s'assure de passer  la minute suivante pour ne pas faire plusieurs photos par jour
            time.sleep(60)

    except IOError:
        print("Erreur")
