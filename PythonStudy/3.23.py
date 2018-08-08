def removeChar(string,letter):
    res = ""
    for i in range(len(string)):
        if letter != string[i]:
            res += string[i]
    return res        


a = "fsddfgffgsdf"
b = "f"
print(removeChar(a,b))
    