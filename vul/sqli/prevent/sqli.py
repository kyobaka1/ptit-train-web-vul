# -*- coding: utf-8 -*-
import requests
import sys

URL = str(sys.argv[1])
post_login = {'username':'Bob', 'password': 'bob123', 'submit':'OK'}
r = requests.post(URL, data=post_login)
if 'Success' in r.text:
    print('<span><img src="public/images/check.png" style="width:24px; height:24px" class="img-circle"/></span>    File is ok! I can login with Bob!</span></br>')
else:
    print('<span><img src="public/images/uncheck.png" style="width:24px; height:24px" class="img-circle"/></span>    Error! File not working!</span></br>')
    exit(0)
lines = [line.rstrip('\r\n') for line in open(sys.argv[2])]
dem = 0
for x in lines:
    post_login = {'username': x, 'password': 'hacker', 'submit': 'OK'}
    r = requests.post(URL, data=post_login)
    if 'Success' in r.text:
        print('<span><img src="public/images/uncheck.png" style="width:24px; height:24px" class="img-circle"/></span>    Error! My payload can exploit it!</span></br>')
        dem += 1
if dem == 0:
    print('<span><img src="public/images/check.png" style="width:24px; height:24px" class="img-circle"/></span>    Congratulation!!!</span></br>')
