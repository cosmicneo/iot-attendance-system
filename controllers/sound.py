from datetime import datetime
import os
import pygame
import time
pygame.mixer.init()



try:
	while True:
		ls = os.listdir("/var/www/html/uploaded_files")
#	print ls
		now = datetime.now()
		current_time = now.strftime("%H%M") #+os.path.splitext(ls[0])[1]
#	print current_time
	
		if current_time in ls:
	#	print ("Hello")
	#	print ls.index(current_time)
			pygame.mixer.music.load("/var/www/html/uploaded_files/"+ls[ls.index(current_time)])
		

			pygame.mixer.music.play()
			while pygame.mixer.music.get_busy() == True:
				continue

		else:
			pass
#		print("Not present")

		time.sleep(10)
except Exception as e :
	print("Exception occured : "+str(e))
