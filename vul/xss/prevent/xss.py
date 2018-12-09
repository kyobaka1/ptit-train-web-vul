# -*- coding: utf-8 -*-
import requests
import sys

URL = str(sys.argv[1])
r = requests.post(URL+'?name=usertest')
if 'Hello usertest' in r.text:
    print('<span><img src="public/images/check.png" style="width:24px; height:24px" class="img-circle"/></span>    File is ok! It running true!</span></br>')
else:
    print('<span><img src="public/images/uncheck.png" style="width:24px; height:24px" class="img-circle"/></span>    Error! File not working!</span></br>')
    exit(0)
lines = [line.rstrip('\r\n') for line in open(sys.argv[2])]
dem = 0
for x in lines:
    URL_dest = URL+'?name='+x
    r = requests.post(URL_dest)
    if x in r.text:
        print('<span><img src="public/images/uncheck.png" style="width:24px; height:24px" class="img-circle"/></span>    Error! My payload can exploit it!</span></br>')
        dem += 1
if dem == 0:
    print('<span><img src="public/images/check.png" style="width:24px; height:24px" class="img-circle"/></span>    Congratulation!!!</span></br>')