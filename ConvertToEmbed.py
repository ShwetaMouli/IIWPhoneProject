index = 1
with open('embedStuff', 'r') as embedlinks:
	with open('embedLinks', 'w') as cleanLinks:
		for embedlink in embedlinks:
			embedlink = embedlink.replace("&index="+str(index)+"&", "?")
			print embedlink, "&index="+str(index)+"&"
			index += 1
			cleanLinks.write(embedlink)