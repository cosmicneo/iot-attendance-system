import hashlib
from pyfingerprint.pyfingerprint import PyFingerprint
from rpi_lcd import LCD
import os
import time

lcd=LCD()

f = PyFingerprint('/dev/ttyUSB1', 57600, 0xFFFFFFFF, 0x00000000)
shift = 0
def finger_init():
	try:

		if ( f.verifyPassword() == False ):
			raise ValueError('The given fingerprint sensor password is wrong!')

	except Exception as e:
		print('The fingerprint sensor could not be initialized!')
		print('Exception message: ' + str(e))
		

def finger_read():
	try:
		while ( f.readImage() == False ):
			pass
			
		f.convertImage(0x01)
		result = f.searchTemplate()
		positionNumber = result[0]
		accuracyScore = result[1]
		

		if ( positionNumber == -1 ):

			return positionNumber	
			
		else:
			return positionNumber
	except Exception as e :
		pass

def finger_delete(temp):
	print('Currently used templates: ' + str(f.getTemplateCount()) +'/'+ str(f.getStorageCapacity()))
	return f.deleteTemplate(temp)

def finger_enroll():
	print('Currently used templates: ' + str(f.getTemplateCount()) +'/'+ str(f.getStorageCapacity()))
	lcd.clear()
	lcd.text("Waiting finger",1)
	while ( f.readImage() == False ):
        	pass
	f.convertImage(0x01)
	result = f.searchTemplate()
	positionNumber = result[0]
	if ( positionNumber >= 0 ):
		lcd.clear()
		lcd.text("Already Enrolled!",1)
		time.sleep(2)
		lcd.clear()
		raise Exception('Already Enrolled!')
	
	lcd.text("Remove Finger...",1)
	time.sleep(2)
	lcd.text("Put Finger Again",1)

	while ( f.readImage() == False ):
		pass

	f.convertImage(0x02)

	if ( f.compareCharacteristics() == 0 ):
		lcd.clear()
		lcd.text("Finger Prints",1)
		lcd.text("Did not match",2)
		time.sleep(2)
		lcd.clear()
		return -1
		exit(0)

	f.createTemplate()
	positionNumber = f.storeTemplate()
	os.system('python /home/cmriseshivpuri/Desktop/buzzer.py &')
	lcd.clear()

	lcd.text("Enroll Success",1)
	time.sleep(2)
	lcd.clear() 
	print('New template position #' + str(positionNumber))
	return positionNumber








