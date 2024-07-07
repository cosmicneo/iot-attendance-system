
import serial
from rpi_lcd import LCD
import buzzer
import mysql.connector
import time
lcd=LCD()
lcd.text("   Punch Mode",1)

while True:
		
	rfid=None

	ser = serial.Serial ("/dev/ttyUSB0")                           #Open named port 
	ser.baudrate = 9600                                            #Set baud rate to 9600
	rfid = ser.read(12)                                            #Read 12 characters from serial port to data
	ser.close ()
	rfid=str(rfid)[2:-1]                                                #Close port
																	#Close port
	try:
		lcd.text("   Punch Mode",1)
		
		mydb = mysql.connector.connect(host = "127.0.0.1", user = "admin", passwd = "123321", database = "Attendance")
		mycursor = mydb.cursor()
		sql = "SELECT * FROM registered_members WHERE rfid ='"+str(rfid)+"'"
		mycursor.execute(sql)
		
		rfid = "null"
		name = "null"
		eclass="null"
		zone="null"
		fingerprintid="null"
		category="null"
		
		
		
		
		for cursor in mycursor:
			rfid = cursor[2]
			fingerprintid = cursor[1]
			name= cursor[0]
			eclass=cursor[4]
			category=cursor[3]
			zone=cursor[5]
		
		if(not eclass):
			eclass='-'

		if(fingerprintid=="null"):
			lcd.text("Database Error",1)
			time.sleep(2)
			lcd.text("   Punch Mode",1)
			continue
			
		
		sql = "insert into member_attendance (name,fingerprintid,rfid,class,date,category) values ('"+name+"','"+str(fingerprintid)+"','"+rfid+"','"+str(eclass)+"',CURDATE(),'"+category+"')" 
	
		mycursor.execute(sql)
		mydb.commit()
		mycursor.close()
		mydb.close()	 
			
		lcd.text("       OK",1)
		buzzer.buzz()
		time.sleep(1)
		lcd.text("   Punch Mode",1)

	except mysql.connector.errors.IntegrityError:

		lcd.text("Already Punched!",1)
		buzzer.buzz()
		time.sleep(1)
		lcd.text("   Punch Mode",1)
		mycursor.close()
		mydb.close()
		continue
			
	except Exception as e:
		lcd.clear()
		lcd.text("     Error !",1)	
		time.sleep(2)
		lcd.text("   Punch Mode",1)
		print (type(e))
		mycursor.close()
		mydb.close()
		continue


