import psycopg2
from psycopg2 import OperationalError

class SINGIN:

    @staticmethod
    def add_credentials(username, password):
        # Perform basic checks on username and password
        if not (SINGIN.check_username(username) and SINGIN.check_password(password)):
            return False

        # Attempt to connect to the PostgreSQL database
        try:
            conn = psycopg2.connect(
                dbname='boiafeup01',
                user='boiafeup01',
                password='es-n-2024',
                host='db.fe.up.pt',
                port='5432'
            )
            cursor = conn.cursor()

            # Check if the username already exists
            cursor.execute("SELECT password FROM data.credentials WHERE username = %s", (username,))
            result = cursor.fetchone()

            if result is not None:
                print("Username already exists.")
                return False

            # Insert the new credentials into the database
            query = "INSERT INTO data.credentials (username, password) VALUES (%s, %s)"
            cursor.execute(query, (username, password))
            conn.commit()
            print("Credentials added successfully.")
            return True
        except OperationalError as err:
            print(f"Database connection error: {err}")
            return False
        except Exception as err:
            print(f"Error: {err}")
            conn.rollback()
            return False
        finally:
            if cursor:
                cursor.close()
            if conn:
                conn.close()

    @staticmethod
    def check_username(username):
        if len(username) < 5:
            print("The username must have more than 4 letters.")
            return False
        return True

    @staticmethod
    def check_password(password):
        if len(password) < 4:
            print("The password must have more than 3 letters.")
            return False
        return True

# Example usage
if __name__ == "__main__":
    new_username = input("Enter username: ")
    new_password = input("Enter password: ")
    success = SINGIN.add_credentials(new_username, new_password)
    if success:
        print("User added successfully.")
    else:
        print("Failed to add user.")
