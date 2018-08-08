rainfile = open("rainfall.txt", "r")

for aline in rainfile:
    values = aline.split()
    print(values[0], "had", values[1], "inches of rain.")

rainfile.close()