#!/usr/bin/python
# -*- coding: utf-8 -*-
#  /home/pi/wiringPi/examples/lights
#
# date 07-apr-14
# version 2.0 hwi
#
#

import MySQLdb as mdb
import time
import sunrise
import datetime as dt

from subprocess import call


#function switch_kaku
def switch_kaku( sdevid, action, ksource ):
        switch = mdb.connect('localhost','testuser','test623','testdb');
        with switch:
                slcur = switch.cursor()
                # get actual switchtime
                now_c = time.localtime(time.time())
                #convert time to string
                switch_time = time.strftime("%Y-%m-%d %H:%M:%S", now_c)
                
                if int(action)==1:
                        #print "AanSchakelmoment "
                        slcur.execute("select * from switchlist where sdevid=%s",(int(sdevid)))
                        nr = slcur.rowcount
                        #check on records, if so delete         
                        if nr>0:
                                slcur.execute("delete from switchlist \
                                                where sdevid = %s",(sdevid))
                        #
                        # building switchcode based on device data and switch on
                        #
                        slcur.execute("select devgroup,devcode from devices where devid=%s",(int(sdevid)))
                        srows = slcur.fetchall()
                        for row in srows:
                                if int(sdevid)<10:
                                        commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
                                                row[0],str(row[1]),"on"
                                        call(commando)
                                        call(commando)
        
                                else:
                                        commando = "sudo","/home/pi/wiringPi/examples/lights/action", \
                                                str(row[1]),row[0],"on" 
                                        call(commando)
                                        call(commando)
        
                        slcur.execute("insert into switchlist(sdevid) \
                                         values (%s)",(sdevid))
        

                if int(action)==0:
                        # print "UitSchakelmoment "
                        #
                        # building switchcode based on device data and switch off
                        #
                        slcur.execute("select devgroup,devcode from devices where devid=%s",(int(sdevid)))
                        srows = slcur.fetchall()
                        for row in srows:
                                if int(sdevid)<10:
                                        commando = "sudo","/home/pi/wiringPi/examples/lights/kaku", \
                                                row[0],str(row[1]),"off"
                                        call(commando)
                                        call(commando)
        
                                else:
                                        commando = "sudo","/home/pi/wiringPi/examples/lights/action", \
                                                str(row[1]),row[0],"off"        
                                        call(commando)
                                        call(commando)

                        slcur.execute("delete from switchlist \
                                        where sdevid = %s",(sdevid))

                #save swithmoment for future use
                add_history = "insert into swhistory (sdevid, swmoment, saction, stype) \
                                        values (%s, %s, %s, %s)"
                slcur.execute(add_history, [sdevid, switch_time, action, ksource])
                switch.commit();
        return;

#function read_timetable
def read_tt():
        con = mdb.connect('localhost','testuser','test623','testdb');
        with con:
                ttcur = con.cursor()
                ttcur.execute("select devid, ntime, ssdelta, srdelta, saction from timetable")
                rows = ttcur.fetchall()
        return rows;



#mainprogram
def main():
                oldtime = "00:00" 
                
                #read timetable
                rows = read_tt()

                #endless loop 
                while True:

                        #loop timetable and compare with currenttime

                        #get current time
                        now = time.localtime(time.time())
                        current_time = time.strftime("%H:%M", now)      


                        #get the sunrise time for Wageningen
                        s = sunrise.sun(lat=51.8,long=5.40)

                        #convert time to a datetime
                        sr = dt.datetime.combine(dt.date(1901,1,1),s.sunrise())
                        ss = dt.datetime.combine(dt.date(1901,1,1),s.sunset() )

                        if current_time == '08:30':
                                rows = read_tt()


                                                
                        if current_time != oldtime:
                                #print current_time
                                for row in rows:
                                        if row[1] is not None:
                                                #there is a switchtime
						#print "%s %s %s %s %s" % row
                                                if row[1] == current_time:        
                                                        switch_kaku(row[0],row[4],'A');
                                        else:
                                                #we have a sunrise/set time
                                                if row[3] is None:
                                                        #sunset
                                                        #calculate time
                                                        delta_s = dt.timedelta(minutes=row[2])
                                                        ss =  ss + delta_s

                                        		#sstime=ss
							sstime=ss.strftime("%H:%M")
							
							#print('SS',sstime)

                                                        if sstime == current_time:
                                                                #print "%s %s %s %s %s" % row
                                                                switch_kaku(row[0],row[4],'A');
                                                else:
                                                        #sunrise
                                                        #calculate time
                                                        delta_r = dt.timedelta(minutes=row[3])
                                                        sr =  sr + delta_r
                                                        
							srtime=time.strftime("%H:%M")  
							#print('sr',srtime)
							
                                                        if srtime == current_time:
                                                                #print "%s %s %s %s %s" % row
                                                                switch_kaku(row[0],row[4],'A');

                        #to ensure we switch oly one time per minute 
                        oldtime = current_time
                return;


#run the mainprogram
if __name__ == "__main__":
    main()

