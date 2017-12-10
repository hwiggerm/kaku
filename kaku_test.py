#!/usr/bin/python
# -*- coding: utf-8 -*-
#  /home/pi/wiringPi/examples/lights

import MySQLdb as mdb
import time
from subprocess import call

con = mdb.connect('localhost','testuser','test623','testdb');

#function switch_kaku
def switch_kaku( sdevid, action ):
	slcur = con.cursor()
	if action==1:
		# print "AanSchakelmoment "
		slcur.execute("select * from switchlist where sdevid=%s",(sdevid))
		nr = slcur.rowcount
		#check on records, if so delete		
		if nr>0:
			slcur.execute("delete from switchlist \
					where sdevid = %s",(sdevid))


		#
		# building switchcode based on device data and switch on
		#
		slcur.execute("select devgroup,devcode from devices where devid=%s",(sdevid))
		rows = slcur.fetchall()
		for row in rows:
			commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
				row[0],str(row[1]),"on"
			call(commando)
			call(commando)

		slcur.execute("insert into switchlist(sdevid) \
					 values (%s)",(sdevid))
	

	if action==0:
		# print "UitSchakelmoment "
		#
		# building switchcode based on device data and switch off
		#
		slcur.execute("select devgroup,devcode from devices where devid=%s",(sdevid))
		rows = slcur.fetchall()
		for row in rows:
			commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
				row[0],str(row[1]),"off"
			call(commando)
			call(commando)

		slcur.execute("delete from switchlist \
				where sdevid = %s",(sdevid))

	#save swithmoment for future use
	
	add_history = "insert into swhistory (sdevid, swmoment, saction) \
				values (%s, %s, %s)"
	slcur.execute(add_history, [sdevid, current_time, action])
	con.commit(); 
	return;

#function recovery
def recover_kaku():
	reccur = con.cursor()
	reccur.execute("select sdevid from switchlist")
	rows = reccur.fetchall()
	for row in rows:
		#
		# building switchcode based on device data and switch on
		#
		slcur.execute("select devgroup,devcode from devices where devid=%s",(sdevid))
		rows_1 = slcur.fetchall()
		for row_1 in rows_1:
			commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
				row_1[0],str(row_1[1]),"on"
			call(commando)

	return;

#function allon
def all_on():
	reccur = con.cursor()
	reccur.execute("select * from devices")
	rows = reccur.fetchall()
	for row in rows:
		print row[0]
		commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
					row[2],str(row[3]),"on"
		call(commando)

	return;

#function allof
def all_off():
	reccur = con.cursor()
	reccur.execute("select * from devices")
	rows = reccur.fetchall()
	for row in rows:
		print row[0]
		commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
					row[2],str(row[3]),"off"
		call(commando)

	return;


#mainprogram
ttcur = con.cursor()
oldtime = "00:00" 

all_off()

