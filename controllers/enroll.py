import finger
import sys
import mysql.connector  
from rpi_lcd import LCD
import time
import buzzer
import rf

lcd=LCD()
lcd.text("Place RFID Card",1)

id = rf.read_rfid() 

lcd.text(f"RFID number is: {id}",1)
lcd.text(id,2)
time.sleep(2)
#lcd.clear()
mycursor=None
try:
	positionNumber=finger.finger_enroll()
	
	if(positionNumber==-1):
		exit(0)
	mydb = mysql.connector.connect(host = "localhost", user = "admin", passwd = "123321", database = "Attendance")
	mycursor = mydb.cursor() 
	if(sys.argv[1]=="student"):	
		sql = "INSERT INTO registered_members (name,fingerprintid,rfid,category,class) values('"+sys.argv[2]+"','"+str(positionNumber)+"','"+str(id)+"','"+sys.argv[1]+"','"+sys.argv[3]+"')"      
	else:
		sql = "INSERT INTO registered_members (name,fingerprintid,rfid,category) values('"+sys.argv[2]+"','"+str(positionNumber)+"','"+str(id)+"','"+sys.argv[1]+"')"	
	mycursor.execute(sql)
	mydb.commit()
	mycursor.close()
	mydb.close()	 
	print(mycursor.rowcount, "record inserted to" + sys.argv[1])
	#lcd.clear()
	lcd.text("Enroll Success!",1)
	buzzer.buzz()
	time.sleep(1)
	#lcd.clear()
	lcd.text("   Punch Mode",1)
except Exception as e:
	lcd.text("Error !",1)
	time.sleep(1)
	#lcd.clear()
	lcd.text("   Punch Mode",1)
	
	print(e)
	if(mycursor):
		mycursor.close()
		mydb.close()	
   	
