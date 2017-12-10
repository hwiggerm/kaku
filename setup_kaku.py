#!/usr/bin/python
# -*- coding: utf-8 -*-
# 
# date 25-09-14
# version 2.0 hwi
# include sunset/rise
#

import MySQLdb as mdb
import sys

con = mdb.connect('localhost','testuser','test623','testdb');

with con:

	cur = con.cursor()

#drop existing table
	cur.execute("drop table if exists timetable")
	cur.execute("drop table if exists devices")
	cur.execute("drop table if exists switchlist")
#	cur.execute("drop table if exists swhistory")

#create tables
	cur.execute("create table timetable(devid int, ntime varchar(100), \
			srdelta int, ssdelta int, \
			saction int)")

	cur.execute("create table devices(devid int primary key, \
			description varchar(255),devgroup varchar(1), devcode int)")

	cur.execute("create table switchlist(sdevid int)")

#	cur.execute("create table swhistory(sdevid int, swmoment varchar(100), \
#			saction int, stype varchar(1))")

#insert data for devices and timetable

#Eurodomest-switches id <0
#kika-switches id>0 and  <=10


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(8,'Kerstboom','a',1)")

	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(9,'Buitenverlichting','a',2)")

#	cur.execute("insert into devices(devid, description, \
#			devgroup, devcode) values(6,'Vijver','a',3)")



	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(7,'Buiten','b',1)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-1,'Eurodomest-1','b',2)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-2,'Eurodomest-2','b',3)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-3,'Eurodomest-3','b',4)")



	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(4,'Bibliotheek','c',1)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-7,'Kerstlamp Garage','c',2)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-4,'Eurodomest-4','c',3)")



	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(3,'Woonkamer','d',1)")

			
	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(1,'Kroonluchter','d',2)")

			
	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(-6,'Kroonluchter','d',2)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(5,'Boven-overloopjongens','d',3)")	


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(2,'Serre','e',1)")




#action-switches id>10
#	cur.execute("insert into devices(devid, description, \
#			devgroup, devcode) values(11,'marc','C',1)")

	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(11,'Kerst_buiten_garage','C',1)")


	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(12,'defect','B',1)")

	cur.execute("insert into devices(devid, description, \
			devgroup, devcode) values(13,'slaapkamer','A',1)")



#bib
	cur.execute("insert into timetable(devid, ssdelta, saction) values(4,30,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(4,'22:50',0)")


#woonkamer
	cur.execute("insert into timetable(devid, ssdelta, saction) values(3,-20,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(3,'22:45',0)")

#slaapkamer
	cur.execute("insert into timetable(devid, ntime, saction) values(13,'22:30',1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(13,'23:10',0)")

#slaapkamerMarc
#	cur.execute("insert into timetable(devid, ntime, saction) values(11,'22:01',1)")
#	cur.execute("insert into timetable(devid, ntime, saction) values(11,'22:24',0)")
		
#boven-overloop	
	cur.execute("insert into timetable(devid, ssdelta, saction) values(5,20,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(5,'22:30',0)")

#buiten
	cur.execute("insert into timetable(devid, ntime, saction) values(7,'22:10',1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(7,'23:40',0)")


#kerstverlichting buiten
	cur.execute("insert into timetable(devid, ssdelta, saction) values(-6,-45,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(-6,'23:14',0)")

	cur.execute("insert into timetable(devid, ssdelta, saction) values(-7,-45,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(-7,'23:14',0)")

#kerstboom
	cur.execute("insert into timetable(devid, ssdelta, saction) values(8,-30,1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(8,'23:35',0)")

	cur.execute("insert into timetable(devid, ssdelta, saction) values(8,'6:05',1)")
	cur.execute("insert into timetable(devid, ntime, saction) values(8,'7:30',0)")





#vijver
#	cur.execute("insert into timetable(devid, ntime, saction) values(6,'10:30',1)")
#	cur.execute("insert into timetable(devid, ntime, saction) values(6,'12:50',0)")

#Sere
#        cur.execute("insert into timetable(devid, ssdelta, saction) values(2,0,1)")
#        cur.execute("insert into timetable(devid, ssdelta, saction) values(2,90,0)")


#
#check if data is in the system	
	cur.execute("select * from devices")
	for i in range(cur.rowcount):
		row = cur.fetchone()
		print row[0], row[1], row[2],row[3]


        cur.execute("select * from timetable")
        for i in range(cur.rowcount):
                row = cur.fetchone()
                print row[0], row[1], row[2],row[3],row[4]

