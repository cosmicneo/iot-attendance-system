#!/usr/bin/env python
# -*- coding: utf-8 -*-

import os
import types
from datetime import datetime
import mysql.connector
from rpi_lcd import LCD

import time
import buzzer


import finger
from datetime import date

lcd=LCD()
os.system('sudo python3 /home/cmriseshivpuri/Desktop/rf_run.py &')

while True:
	

	try:
		#lcd.clear()
		lcd.text("   Punch Mode",1)
		finger.finger_init()
		positionNumber =finger.finger_read()
		
		if positionNumber== -1:
			#lcd.clear()
			lcd.text("Finger not Found",1)
			buzzer.buzz()

			time.sleep(1)
			lcd.text("   Punch Mode",1)
			continue
		
		mydb = mysql.connector.connect(host = "127.0.0.1", user = "admin", passwd = "123321", database = "Attendance")
		mycursor = mydb.cursor()
		sql = "SELECT * FROM registered_members WHERE fingerprintid ='"+str(positionNumber)+"'"
	 	
		mycursor.execute(sql)
		
		rfid = "null"
		name = "null"
		eclass="null"
		zone="null"
		category="null"
			
		for cursor in mycursor:
			rfid = cursor[2]
			name= cursor[0]
			eclass=cursor[4]
			category=cursor[3]
			zone=cursor[5]
		
		if(not eclass):
			eclass='-'

		
		sql = "insert into member_attendance (name,fingerprintid,rfid,class,date,category) values ('"+name+"','"+str(positionNumber)+"','"+rfid+"','"+str(eclass)+"',CURDATE(),'"+category+"')" 
		

		mycursor.execute(sql)
		mydb.commit()
		
		mycursor.close()
		mydb.close()	 
		#lcd.clear()
		lcd.text("       OK",1)
		buzzer.buzz()
		time.sleep(1)
		lcd.text("   Punch Mode",1)
		
	except mysql.connector.errors.IntegrityError:
		#lcd.clear()
		lcd.text("Already Punched!",1)
		buzzer.buzz()

		time.sleep(1)
		lcd.text("   Punch Mode",1)
		mycursor.close()
		mydb.close()
		continue
			
	except Exception as e:
		#lcd.clear()
		lcd.text("     Error !",1)	
		time.sleep(2)
		lcd.text("   Punch Mode",1)
		print (type(e))
		mycursor.close()
		mydb.close()
		continue
	
	
		
		
