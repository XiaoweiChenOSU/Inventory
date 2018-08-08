def toDic(names,values):
    res = dict()
    for i in range(len(names)):
        res[names[i]] = values[i]
    return res        


names = ['joe','tom','barb','sue','sally']
scores = [10, 23, 13, 18, 12]
scoreDic = toDic(names,scores)
scoreDic['john'] = 19
print(scoreDic)
grade = sorted(scoreDic.values())
print(grade)
print(sum(grade)/float(len(grade)))
print(sum(grade)/len(grade))
scoreDic['sally'] = 13
print(scoreDic)
del scoreDic['tom']
print(scoreDic)
namesort = sorted(scoreDic.keys())
for i in range(len(namesort)):
    print(namesort[i],'  ' , scoreDic[namesort[i]])


def getScore(name, dicti):
    if name in dicti.keys():
        print("The score of" ,name, " is",dicti[name])
    else:
        print("Your name is not here, please check")
        return -1
name = 'sue'
getScore(name,scoreDic)

def mode(alist):
    countdict = {}
    for item in alist:
        if item in countdict:
            countdict[item] += 1
        else:
            countdict[item] = 1
    countlist = countdict.values()
    maxcount = max(countlist)


    modelist = []
    for item in countdict:
        if countdict[item] == maxcount:
            modelist.append(item)
    return modelist   


test = [1,1,4,5,6,2,4,7,1,4,6,1]
print(mode(test))

test = [1,1,1,2,2,2,3,3,3,4,4,4,4,5,5,5,5,6,6]
print(mode(test))

def frequencyTableAlt(alist):
    print('ITEM','FREQUENCY')
    slist = alist[:]
    slist.sort()

    countlist = []

    previous = slist[0]
    groupCount = 0
    for current in slist:
        if current == previous:
            groupCount = groupCount + 1
            previous = current
        else:
            print(previous, "   ", groupCount)
            previous = current
            groupCount = 1

    print(current, "   ", groupCount)  


frequencyTableAlt(test)


def frequencyTableList(alist):
    slist = alist[:]
    slist.sort()

    res = []

    previous = slist[0]
    groupCount = 0
    for current in slist:
        if current == previous:
            groupCount = groupCount + 1
            previous = current
        else:
            res.append((previous,groupCount))
            previous = current
            groupCount = 1

    res.append((current,groupCount))  
    return res

print(frequencyTableList(test))  
