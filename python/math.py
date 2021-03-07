def ciag():
    n = int(input(" (Ciag) Podaj liczbę n: "))
    if n == 0:
        return 0
    elif n == 1:
        return 1
    wynik, last = 0, 1
    for x in range(n+1):
        yield wynik
        wynik, last = last, wynik + last

def silnia():
    n = int(input(" (Silnia) Podaj liczbę n: "))
    wynik = 1
    if n == 0:
        return 1
    elif n >= 1:
        for x in range(1, 1+n):
            wynik = wynik * x
        return wynik

def minmax():
    list=[]
    while True:
        n=input("Podaj liczbę: ")
        if n == "-":
            break
        list.append(int(n))

    return f"Najwieksza liczba to {max(list)}\nNajmniejsza liczba to {min(list)}"

print(silnia())
print(list(ciag()))
print(minmax())
