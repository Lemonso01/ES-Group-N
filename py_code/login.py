import psycopg2
from psycopg2 import OperationalError

class LOGIN:

    @staticmethod
    def check_credentials(username, password):
        # Perform basic checks on username and password
        if not (LOGIN.check_username(username) and LOGIN.check_password(password)):
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

            # Check if the credentials exists
            cursor.execute("SELECT password FROM data.credentials WHERE username = %s AND password = %s", (username, password))
            result = cursor.fetchone()

            if result is not None:
                print("Login successful.")
                return True

            print("Credentials don't match a user.")
            return False
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
    success = LOGIN.check_credentials(new_username, new_password)
    if success:
        print("User logged in successfully.")
    else:
        print("Failed to login user.")
