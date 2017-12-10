import sys
import urllib2
import json
f = urllib2.urlopen('http://api.wunderground.com/api/4260b52e74b94e6a/geolookup/conditions/q/nl/wageningen.json')
json_string = f.read()
parsed_json = json.loads(json_string)
location = parsed_json['location']['city']
temp_c = parsed_json['current_observation']['temp_c']
print "Current temperature in %s is: %s" % (location, temp_c)
f.close()
