import sys
import urllib2
import json
f = urllib2.urlopen('http://api.wunderground.com/api/4260b52e74b94e6a/geolookup/astronomy/q/nl/wageningen.json')
json_string = f.read()
parsed_json = json.loads(json_string)

#zon op
uur_op = parsed_json['sun_phase']['sunrise']['hour']
minuut_op = parsed_json['sun_phase']['sunrise']['minute']
print "zon op %s:%s" % (uur_op, minuut_op)



#zon onder
uur_onder = parsed_json['sun_phase']['sunset']['hour']
minuut_onder = parsed_json['sun_phase']['sunset']['minute']
print "zon onder %s:%s" % (uur_onder, minuut_onder)
f.close()
