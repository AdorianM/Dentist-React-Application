from flask import Flask, request
from flask_mail import Mail, Message
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
mail= Mail(app)

app.config['MAIL_SERVER']='smtp.gmail.com'
app.config['MAIL_PORT'] = 465
app.config['MAIL_USERNAME'] = 'adorian.g.mititean@gmail.com'
app.config['MAIL_PASSWORD'] = 'ca355f31'
app.config['MAIL_USE_TLS'] = False
app.config['MAIL_USE_SSL'] = True
mail = Mail(app)

@app.route("/mail", methods=['GET', 'POST'])
def index():
   form_json = request.get_json()

   if not form_json:
      print("Missing json")
      return "Missing json", 404

   name = form_json.get('name')
   phone = form_json.get('phone')
   info = form_json.get('info')

   msg = Message('Mail sent!', 
         sender = 'adorian.g.mititean@gmail.com', 
         recipients = ['Adorian.Mititean@gmail.com'])
   msg.body = ("This message was sent by: " + name +
               "\nMy phone number is: " + phone +
               "\n\nI want to tell you the following: " + info)
   mail.send(msg)
   return "Sent"

if __name__ == '__main__':
   app.run(debug = True) 