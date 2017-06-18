# -*- coding: utf-8 -*-
import base_donnee
import ephem

# récuperer l'heure de lever du soleil
o = ephem.Observer()
# verifier que c'est bien en France
o.lat ='49'
o.long ='3'
s = ephem.Sun()
s.compute()

date_heure = ephem.localtime(o.next_rising(s))
date_heure = str (date_heure)

heure = date_heure[11:13]
heure = int(heure)

minute = date_heure[14:16]
minute = int(minute)

# cas où l'utilisateur n'a pas coché la case
if (base_donnee.sunset == 0):
    debut_jour = base_donnee.debut_eclairage

# cas où l'utilisateur a coché la case
else:
    if (minute<30):
        debut_jour = heure
    else:
        debut_jour = heure + 1