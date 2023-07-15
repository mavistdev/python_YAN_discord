import requests as r
import mavist
import time

startup = True
getlink = ''
wmlink = ''
walink = ''
wrlink = ''

while True:
	if startup:
		startup = False
		a = r.get(getlink)
		wrtoday, wryesterday, wrmounth = a.json()['wrdn']['today'], a.json()['wrdn']['yesterday'], a.json()['wrdn']['mounth']
		watoday, wayesterday, wamounth = a.json()['warden']['today'], a.json()['warden']['yesterday'], a.json()['warden']['mounth']
		wmtoday, wmyesterday, wmmounth = a.json()['wardenmobile']['today'], a.json()['wardenmobile']['yesterday'], a.json()['wardenmobile']['mounth']

		rwrtoday, rwryesterday, rwrmounth = wrtoday, wryesterday, wrmounth
		rwatoday, rwayesterday, rwamounth = watoday, wayesterday, wamounth
		rwmtoday, rwmyesterday, rwmmounth = wmtoday, wmyesterday, wmmounth
		mavist.Log.dislog(wrlink, f'''Сегодня - {wrtoday}
Вчера - {wryesterday}
Месяц - {wrmounth}''')
		mavist.Log.dislog(walink, f'''Сегодня - {watoday}
Вчера - {wayesterday}
Месяц - {wamounth}''')
		mavist.Log.dislog(wmlink, f'''Сегодня - {wmtoday}
Вчера - {wmyesterday}
Месяц - {wmmounth}''')
	else:
		a = r.get(getlink)
		wrtoday, wryesterday, wrmounth = a.json()['wrdn']['today'], a.json()['wrdn']['yesterday'], a.json()['wrdn']['mounth']
		watoday, wayesterday, wamounth = a.json()['warden']['today'], a.json()['warden']['yesterday'], a.json()['warden']['mounth']
		wmtoday, wmyesterday, wmmounth = a.json()['wardenmobile']['today'], a.json()['wardenmobile']['yesterday'], a.json()['wardenmobile']['mounth']

	if wrtoday != wrtoday:
		mavist.Log.dislog(wrlink, f'''Сегодня - {wrtoday}
Вчера - {wryesterday}
Месяц - {wrmounth}''')
	else:
		mavist.Log.dislog(wrlink, f'нет изменений')

	if rwatoday != watoday:
		mavist.Log.dislog(walink, f'''Сегодня - {watoday}
Вчера - {wayesterday}
Месяц - {wamounth}''')
	else:
		mavist.Log.dislog(walink, f'нет изменений')
	if rwmtoday != wmtoday:
		mavist.Log.dislog(wmlink, f'''Сегодня - {wmtoday}
Вчера - {wmyesterday}
Месяц - {wmmounth}''')
	else:
		mavist.Log.dislog(wmlink, f'нет изменений')

	rwrtoday, rwryesterday, rwrmounth = wrtoday, wryesterday, wrmounth
	rwatoday, rwayesterday, rwamounth = watoday, wayesterday, wamounth
	rwmtoday, rwmyesterday, rwmmounth = wmtoday, wmyesterday, wmmounth

	# dt  = time.strftime("%H")
	# if dt == 3:
	# 	print('Сравнительная статистика')
	time.sleep(3600) #3600 - 1ч
