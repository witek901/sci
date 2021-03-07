import requests
from bs4 import BeautifulSoup
import re

def format_to_only_numbers(string):
    return re.sub('[^0-9]', '', string)

def firstSite():
    site_url = "https://pogoda.interia.pl/prognoza-szczegolowa-szczecin,cId,34668"
    hdr = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'}
    r = requests.get(site_url, headers=hdr)
    soup = BeautifulSoup(r.text, features="html.parser")

    temp = soup.find("li", {"class": "feelTemperature"}).findChildren("span")[0].string
    pressure = soup.find("li", {"class": "pressure"}).findChildren("span")[0].string
    wind = soup.find("li", {"class": "wind"}).findChildren("span")[0].string

    temp = float(format_to_only_numbers(temp))
    pressure = float(format_to_only_numbers(pressure))
    wind = float(format_to_only_numbers(wind))

    return temp, pressure, wind

def secondSite():
    site_url = "https://pogoda.wp.pl/pogoda-dlugoterminowa/szczecin/3083829"
    hdr = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'}
    r = requests.get(site_url, headers=hdr)
    soup = BeautifulSoup(r.text, features="html.parser")

    detail = soup.find("td", {"class": "detail"})
    temp = detail.findChildren("span")[0].string
    pressure = detail.find_next("td").findChildren("span")[0].string
    wind = detail.find_next("td").find_next("td").findChildren("span")[0].string

    temp = float(format_to_only_numbers(temp))
    pressure = float(format_to_only_numbers(pressure))
    wind = float(format_to_only_numbers(wind))

    return temp, pressure, wind

def thirdSite():
    api_key = "fd5f80163c9763f179cd30af84b5a2e9"
    api = f"https://api.openweathermap.org/data/2.5/onecall?lat=53.4289&lon=14.553&exclude=daily&appid={api_key}&units=metric"
    r = requests.get(api).json()

    temp = r["current"]["feels_like"]
    pressure = r["current"]["pressure"]
    wind = r["current"]["wind_speed"] * 3.6

    return temp, pressure, wind

def average():
    temp = (firstSite()[0] + secondSite()[0] + thirdSite()[0]) / 3
    pressure = (firstSite()[1] + secondSite()[1] + thirdSite()[1]) / 3
    wind = (firstSite()[2] + secondSite()[2] + thirdSite()[2]) / 3

    return f"Średnia temperatura: {temp}\nŚrednie ciśnienie: {pressure}\nŚrednia prędkość wiatru: {wind}"

print(average())