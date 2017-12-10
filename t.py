import os, glob, shutil, sys

naam = sys.argv[1]
dest = "/var/www/images/wc/"
usb = "/media/RPI"

#shutil.rmtree(dest)

os.chdir(usb)
os.makedirs(dest+naam)
for file in glob.glob("*"+naam+"*"):
 full_file_name = os.path.join(usb, file)
 if (os.path.isfile(full_file_name)):
       	shutil.copy(full_file_name, dest+naam)
	print(file)

