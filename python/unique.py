my_list = [1, 2, 4, 4, 1, 4, 2, 6, 2, 9]
my_list1 = []

for i in my_list:
    if i not in my_list1:
        my_list1.append(i)

my_list = my_list1

print("The list with unique elements only:")
print(my_list)
