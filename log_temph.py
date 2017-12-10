#!/usr/bin/python
# -*- coding: utf-8 -*-
#
# date 10-dec-2014
# version 2.2 hwi 
# add date from outside throug weatherunderground
# 14/4 add sunset-rise
# 10/12 remove sunset/down because there is a different way to het this + added exception management      

import MySQLdb as mdb
import subprocess
import re
import sys
import time
import datetime
import urllib2
import json

def save_data(stemp, humidity, temp_c):
	con = mdb.connect('localhost','testuser','test623','testdb');
	#put the data in mysql
	slcur = con.cursor()
	add_temp = "insert into tempsensor (devid, mdate, temp, humid, extemp ) values (%s, %s, %s, %s, %s)"	
	params = [1,datetime.datetime.now(), stemp, humidity, temp_c]
	slcur.execute(add_temp, params)
	con.commit()
	return;

while(True):
        try:
                # Run the DHT program to get the humidity and temperature readings!
                output = subprocess.check_output(["/home/pi/kaku/Adafruit_DHT", "11", "4"]);

                # print output
                matches = re.search("Temp =\s+([0-9.]+)", output)

                if (not matches):
                        time.sleep(3)
                        continue
                stemp = float(matches.group(1))
  
                # search for humidity printout
                matches = re.search("Hum =\s+([0-9.]+)", output)
                if (not matches):
                        time.sleep(3)
                        continue
                humidity = float(matches.group(1))
  
                #read outsidetemp from wunderground
                f = urllib2.urlopen('http://api.wunderground.com/api/4260b52e74b94e6a/geolookup/conditions/q/nl/wageningen.json')
                json_string = f.read()
                parsed_json = json.loads(json_string)
                temp_c = parsed_json['current_observation']['temp_c']
                f.close()

             
                f.close()


                #put the data in mysql
                save_data(stemp, humidity, temp_c )

                # Wait 120 seconds before continuing
                time.sleep(1200)

        except:
                pass
