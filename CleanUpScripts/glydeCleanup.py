with open('/Users/shmouli/Documents/Sem3/IIW/Project/Data/ConsolidatedGlyde.tsv', 'rU') as glydedataFile:
	with open('/Users/shmouli/Documents/Sem3/IIW/Project/Data/ConsolidatedGlyde1.tsv', 'w') as glydeout:
		index = 0
		currPhone = ''
		concatSpecs = []
		concatPrices = []
		concatImgs = []
		glydedata = glydedataFile.readlines()

		for i in range(len(glydedata)):
			glydedata[i]=glydedata[i].lstrip().rstrip().split('\t')
			print glydedata[i]
			if i == 0:
				currPhone = glydedata[i][0]
				concatSpecs.append(glydedata[i][1])
				concatPrices.append(glydedata[i][2])
				concatImgs.append(glydedata[i][3])
			if currPhone != glydedata[i][0]:

				allSpecs = '*delim*'.join(concatSpecs)
				allPrices = '*delim*'.join(concatPrices)
				allImgs = '*delim*'.join(concatImgs)
				print currPhone+'\t'+allSpecs+'\t'+allPrices+'\t'+allImgs+'\n'
				glydeout.write(currPhone+'\t'+allSpecs+'\t'+allPrices+'\t'+allImgs+'\n')
				currPhone = glydedata[i][0]
				concatSpecs = [glydedata[i][1]]
				concatPrices = [glydedata[i][2]]
				concatImgs = [glydedata[i][3]]
			else:

				concatSpecs.append(glydedata[i][1])
				concatPrices.append(glydedata[i][2])
				concatImgs.append(glydedata[i][3])