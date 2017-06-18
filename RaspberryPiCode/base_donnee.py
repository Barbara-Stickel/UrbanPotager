# -*- coding: utf-8 -*-
import MySQLdb


# serial du raspberry
serial = ("00000000c766dc8c")

# Connection à la base de données
db = MySQLdb.connect("localhost","root","root","dataPotager")

# executer une requete
cursor = db.cursor()

#acceder à l'utilisateur
query_user = """SELECT id FROM user WHERE raspberry= %s"""
cursor.execute(query_user, serial)
data = cursor.fetchone()
user = data[0]

print("user", user)

# identifiant des plantes
query_id_plante = """SELECT id_plante FROM lien_plante WHERE id_user = %s"""
cursor.execute(query_id_plante, user)
data = cursor.fetchall()

id_plante = list()
for i in [0,1,2,3]:
    id_plante.append(data[i][0])

print("id_plante ", id_plante)


# temps arrosage chaque plante
query_arrosage = """SELECT arrosage FROM plantes WHERE id = %s"""
nbre_arrosage_plante = list()
for i in [0,1,2,3] :
    cursor.execute(query_arrosage , id_plante[i])
    data  = cursor.fetchone()
    nbre_arrosage_plante.append(data[0])

print("nombre arrosage plante ", nbre_arrosage_plante)

# temps eclairage
temps_eclairage_plante = list()
for i in [0,1,2,3]:
    query_eclairage = """SELECT eclairage FROM plantes WHERE id = %s"""
    cursor.execute(query_eclairage , id_plante[i])
    data = cursor.fetchone()
    temps_eclairage_plante.append(data[0])

print("temps eclairage plante ", temps_eclairage_plante)

# sunset
query_sunset = """SELECT sunset FROM user WHERE id = %s"""
cursor.execute(query_sunset, user)
data = cursor.fetchone()
sunset = data[0]

print("sunset ", sunset)

# début de l'éclairage si le sunset est à 0
query_debut_eclairage = """SELECT start FROM user WHERE id = %s"""
cursor.execute(query_debut_eclairage, user)
data = cursor.fetchone()
debut_eclairage = data[0]

# nombre d'arrosage minimum
nbre_arrosage_par_jour = min(nbre_arrosage_plante)

# temps moyen d'éclairage
def moyenne(liste):
    resultat = 0
    i = 0
    while i<=len(liste)-1:
        resultat = resultat + liste[i]
        i +=1
    resultat = resultat/len(liste)
    return resultat

temps_eclairage = moyenne(temps_eclairage_plante)


