from selenium import webdriver
from selenium.webdriver.firefox.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time
from config import first_name, email, last_name, passw 

service = Service(excutable_path='./geckodriver.exe')
options = webdriver.FirefoxOptions()
driver = webdriver.Firefox(service=service, options=options)
try: 
    driver.maximize_window()
    driver.get('http://localhost:8080/register.php')
    time.sleep(2)
    first_name_input = driver.find_element(By.XPATH, '/html/body/form/input[1]')
    first_name_input.clear
    first_name_input.send_keys(first_name)
    time.sleep(1)
    password_input = driver.find_element(By.XPATH, '/html/body/div[2]/form/div[2]/input')
    password_input.clear
    password_input.send_keys(admin_password)
    time.sleep(1)
    login_button_input = driver.find_element(By.XPATH, '/html/body/div[2]/form/button').click()
    time.sleep(3)
    admin = driver.find_element(By.XPATH, '/html/body/div[1]/a[2]').click()
    time.sleep(1)
    
    FIO = driver.find_element(By.XPATH, '/html/body/form[2]/input[1]')
    FIO.send_keys(userFIO)
    time.sleep(1)

    email = driver.find_element(By.XPATH, '/html/body/form[2]/input[2]')
    email.send_keys(userEmail)
    time.sleep(1)

    login = driver.find_element(By.XPATH, '/html/body/form[2]/input[3]')
    login.send_keys(userLogin)
    time.sleep(1)

    password = driver.find_element(By.XPATH, '/html/body/form[2]/input[4]')
    password.send_keys(userPassword)
    time.sleep(1)

    role = driver.find_element(By.XPATH, '/html/body/form[2]/input[5]')
    role.send_keys(userRole)
    time.sleep(10)

    button = driver.find_element(By.XPATH, '/html/body/form[2]/button').click()
    

except Exception as e:
    print(e)

finally:
    driver.close
    driver.quit