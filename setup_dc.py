#!/usr/bin/python
# -*- coding: utf-8 -*-
# 
# date 02-01-14
# version 1.0 hwi
#
#

import MySQLdb as mdb
import sys

con = mdb.connect('localhost','testuser','test623','testdb');

with con:

	cur = con.cursor()

#drop existing table
	cur.execute("drop table if exists energy")
	cur.execute("drop table if exists weight")

#create tables
	cur.execute("create table energy(edate varchar(20), elect int, sunb int, sung int, gas int)")
	cur.execute("create table weight(edate varchar(20), weight float)")

