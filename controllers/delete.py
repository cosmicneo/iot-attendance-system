#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import time
import mysql.connector
from rpi_lcd import LCD
import finger
import buzzer

category="null"

lcd = LCD()

finger.finger_init()

try:
	positionNumber = int(sys.argv[1])	
	mydb = mysql.connector.connect(host = "127.0.0.1", user = "admin", passwd = "123321", database = "Attendance")
	mycursor = mydb.cursor() 
	sql = "select * from registered_members where fingerprintid = "+str(positionNumber)
	mycursor.execute(sql)
	for cursor in mycursor:
		category = cursor[3]
	
	if(category != sys.argv[2]):
		lcd.text("No record found!",1)
		raise ValueError('No record found')
   
	mycursor.close()
	mydb.close()
	if ( finger.finger_delete(positionNumber) == True ):
	
		

		mydb = mysql.connector.connect(host = "localhost", user = "admin", passwd = "123321", database = "Attendance")
		mycursor = mydb.cursor() 
		sql = "Delete from registered_members where fingerprintid = "+str(positionNumber)
		mycursor.execute(sql)
		mydb.commit() 
		mycursor.close()
		mydb.close()
		lcd.text("Finger Print ID:",1)
		lcd.text(" deleted !",1)
		buzzer.buzz()
		time.sleep(1)
		lcd.text("   Punch Mode",1)
		
except Exception as e:
	lcd.text("    Error !",1)
	time.sleep(2)
	lcd.text("   Punch Mode",1)

	mycursor.close()
	mydb.close()
