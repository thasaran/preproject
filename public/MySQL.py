import paho.mqtt.client as mqtt
import pymysql
import json
import pandas as pd
import datetime

# MySQL configuration
db = pymysql.connect(
    host="containers-us-west-153.railway.app",
    port=6300,
    user="root",
    password="2z3BskkBbvcnhQN6h445",
    database="railway"
)
cursor = db.cursor()

# MQTT configuration
broker_url = "en-apis.zifisense.com"
broker_port = 1883
topic1 = "980f70347bc145c8a0adb4a34a76b264/jll/property/ms/4f030b39/updata" #topic ของ Air_temp
topic2 = "980f70347bc145c8a0adb4a34a76b264/jll/property/ms/4f039a97/updata" #topic ของ RS485
username = "980f70347bc145c8a0adb4a34a76b264"
password = "a7ae992006b5486bbda172e1752303aa"

def Air_temp_convert(data): #function แปลงค่าจาก sensor
  number_str = str(data)  # แปลงตัวเลขเป็น string
  number_str = number_str[3:]  # ตัดเลข 3 หลักข้างหน้าออก
  temp = number_str[0:3]
  temp_dec = (int(temp,16)/10)
  return temp_dec

def Air_humid_convert(data): #function แปลงค่าจาก sensor
  number_str = str(data)  # แปลงตัวเลขเป็น string
  number_str = number_str[3:]  # ตัดเลข 3 หลักข้างหน้าออก
  humid = number_str[3:]
  humid_dec = int(humid,16)
  return humid_dec

def Soil_temp_convert(data): #function แปลงค่าจาก sensor
  number_str = str(data)  # แปลงตัวเลขเป็น string
  number_str = number_str[4:]  # ตัดเลข 4 หลักข้างหน้าออก
  temp = number_str[5:]
  temp_dec = (int(temp,16)/10)
  return temp_dec

def Soil_humid_convert(data): #function แปลงค่าจาก sensor
  number_str = str(data)  # แปลงตัวเลขเป็น string
  number_str = number_str[4:]  # ตัดเลข 3 หลักข้างหน้าออก
  humid = number_str[0:4]
  humid_dec = (int(humid,16)/10)
  return humid_dec

def Soil_humid_status_convert(data): #function แปลงค่าจาก sensor
  number_str = str(data)  # แปลงตัวเลขเป็น string
  number_str = number_str[4:]  # ตัดเลข 3 หลักข้างหน้าออก
  humid = number_str[0:4]
  humid_dec = (int(humid,16)/10)
  if humid_dec >= 35.6:
    status = "0"
  elif humid_dec >= 34.3:
    status = "40-120"
  elif humid_dec >= 33.8:
    status = "120-200"
  elif humid_dec >= 31.2:
    status = "200-280"
  elif humid_dec >= 27.4:
    status = "280-360"
  elif humid_dec >= 22.0:
    status = "360-440"
  elif humid_dec >= 11.7:
    status = "440-520"
  elif humid_dec >= 0:
    status = "520-600"
  return status
################################################################################

# Callback function when MQTT message is received
def on_message(client, userdata, message):
    payload = message.payload.decode('utf-8')
    data = json.loads(payload)
    sql = "INSERT INTO device (name, data, temp, humid, uptime) VALUES (%s, %s, %s, %s, %s)" #ชื่อ column
    sql2 = "INSERT INTO rs485 (name, data, temp, humid, uptime, status) VALUES (%s, %s, %s, %s, %s, %s)" #ชื่อ column
    sql3 = "INSERT INTO air_temp (name, data, temp, humid, uptime) VALUES (%s, %s, %s, %s, %s)" #ชื่อ column
    values1 = data["deviceAlias"]
    values2 = data["data"]
    if values1 == "temp_humid_1":
        air_temp = Air_temp_convert(values2)
        air_humid = Air_humid_convert(values2)
        values3 = data["upTime"]
        unix_timestamp = int(values3) #ทำการแปลงค่า upTime
        datetime_obj = datetime.datetime.fromtimestamp(unix_timestamp / 1000)
        datetime_str = datetime_obj.strftime('%Y-%m-%d %H:%M:%S')
        values = (values1,values2,air_temp,air_humid,datetime_str)
        cursor.execute(sql, values)  # insert data to MySQL
        cursor.execute(sql3, values)  # insert data to MySQL
    else:
        soil_temp = Soil_temp_convert(values2)
        soil_humid = Soil_humid_convert(values2)
        status = Soil_humid_status_convert(values2)
        values3 = data["upTime"]
        unix_timestamp = int(values3) #ทำการแปลงค่า upTime
        datetime_obj = datetime.datetime.fromtimestamp(unix_timestamp / 1000)
        datetime_str = datetime_obj.strftime('%Y-%m-%d %H:%M:%S')
        values = (values1,values2,soil_temp,soil_humid,datetime_str,status)
        values4 = (values1,values2,soil_temp,soil_humid,datetime_str)
        cursor.execute(sql, values4)  # insert data to MySQL
        cursor.execute(sql2, values)  # insert data to MySQL
    db.commit()
    print("Data inserted to MySQL")

###############################################################################
# Connect to MQTT broker and subscribe to topic
client = mqtt.Client()
client.username_pw_set(username=username, password=password)
client.connect(broker_url, broker_port)
client.subscribe(topic1)
client.subscribe(topic2)

# Set callback function for MQTT message
client.on_message = on_message

# Start the loop to receive MQTT messages
client.loop_forever()