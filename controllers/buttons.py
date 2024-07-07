
import time
import lcd
import RPi.GPIO as GPIO
import os
from datetime import datetime

GPIO.setmode(GPIO.BCM)

shutdownPin = 21

GPIO.setup(shutdownPin, GPIO.IN, pull_up_down = GPIO.PUD_UP)



while True:

  shutdownState = GPIO.input(shutdownPin)	
  
  if shutdownState == False:
	 
	lcd.keepwrite("Press for 3 sec.\nto shutdown")
	
	time.sleep(1)
	if GPIO.input(shutdownPin) == False:
		time.sleep(1)
		if GPIO.input(shutdownPin) == False:
			time.sleep(1)
			if GPIO.input(shutdownPin) == False:
				print("DUMPING MYSQL")
				lcd.keepwrite("Machine is \nshutting down...")
				flg = os.system("sudo mysqldump --user=pi --password=pi --result-file=/boot/BackupsDb/temp/Attendance_"+str(datetime.now().date())+".sql --databases Attendance")		
				if flg==0:
					os.system("sudo rm /boot/BackupsDb/Attendance*")	
					os.system("sudo cp /boot/BackupsDb/temp/* /boot/BackupsDb/")
					os.system("sudo rm /boot/BackupsDb/temp/*")
				else:
					lcd.write("Databse backup\nfailed!")			
		
	
		
		
				os.system("sudo shutdown -h now")
			else:
				lcd.keepwrite("   Punch Mode")		
		else:
			lcd.keepwrite("   Punch Mode")		

	else:
		
		lcd.keepwrite("   Punch Mode")
  


