from flask import Flask, jsonify, render_template
import psycopg2
from psycopg2.extras import RealDictCursor
from psycopg2 import OperationalError

app = Flask(__name__)

def get_db_connection():
    try:
        conn = psycopg2.connect(
            dbname='boiafeup01',
            user='boiafeup01',
            password='es-n-2024',
            host='db.fe.up.pt',
            port='5432'
        )
        return conn
    except OperationalError as err:
        print(f"Database connection error: {err}")
        return None

@app.route('/')
def main():
    return render_template('main.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/access')
def access():
    return render_template('access.html')

@app.route('/cookies')
def cookies():
    return render_template('cookies.html')

@app.route('/graphs')
def graphs():
    return render_template('graphs.html')

@app.route('/history')
def history():
    return render_template('history.html')

@app.route('/privacy')
def privacy():
    return render_template('privacy.html')

@app.route('/restricted')
def restricted():
    return render_template('restricted.html')

@app.route('/terms')
def terms():
    return render_template('terms.html')

@app.route('/data')
def data():
    conn = get_db_connection()
    if conn is None:
        return jsonify({"error": "Database connection failed"}), 500
    
    cursor = conn.cursor(cursor_factory=RealDictCursor)
    try:
        cursor.execute('SELECT "pressao", "humidade", "temp_interna", "temp_agua", "agua" FROM data.sensor_data')
        data = cursor.fetchall()
    except Exception as err:
        print(f"Error fetching data: {err}")
        return jsonify({"error": "Error fetching data"}), 500
    finally:
        cursor.close()
        conn.close()
    
    return jsonify(data)

if __name__ == '__main__':
    app.run(debug=True)
