import pymysql.cursors
import datetime
import json

OLD_DATABASE_HOST = 'localhost'
OLD_DATABASE_USER = 'root'
OLD_DATABASE_PASSWORD = ''
OLD_DATABASE_DATABASE = 'fxentxbkke'

NEW_DATABASE_HOST = 'localhost'
NEW_DATABASE_USER = 'root'
NEW_DATABASE_PASSWORD = ''
NEW_DATABASE_DATABASE = 'project4'

def gather_old_data(tablename):
    connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='fxentxbkke',
                             cursorclass=pymysql.cursors.DictCursor)

    with connection:
        with connection.cursor() as cursor:
            query = "SELECT * FROM `" + tablename + "`"
            cursor.execute(query)
            result = cursor.fetchall()
            return result

def gather_new_data(tablename):
    connection = pymysql.connect(host=NEW_DATABASE_HOST,
                             user=NEW_DATABASE_USER,
                             password=NEW_DATABASE_PASSWORD,
                             database=NEW_DATABASE_DATABASE,
                             cursorclass=pymysql.cursors.DictCursor)

    with connection:
        with connection.cursor() as cursor:
            query = "SELECT * FROM `" + tablename + "`"
            cursor.execute(query)
            result = cursor.fetchall()
            return result


# data is the data from the old database, names is a dictionary<old_names, new_names>
def insert_data(data, names, tablename):
    data_ids = {}
    connection = pymysql.connect(host=NEW_DATABASE_HOST,
                             user=NEW_DATABASE_USER,
                             password=NEW_DATABASE_PASSWORD,
                             database=NEW_DATABASE_DATABASE,
                             cursorclass=pymysql.cursors.DictCursor)

    with connection:
        with connection.cursor() as cursor:
            # Create a new record
            for row in data:
                if row.get('customer_id') != None and row['customer_id'] == 0: 
                    continue 
                sql = "INSERT INTO `" + tablename + "` ("
                values = []
                i = 0
                for key in row:
                    if names.get(key) == None:
                        continue
                    sql += "`" + names[key] + "`"
                    values.append(row[key])
                    if i != len(names) - 1:
                        sql += ","
                    i += 1
                sql += ") VALUES ("
                for j in range(0, i):
                    sql += '%s'
                    if j < i-1:
                        sql += ', '
                sql += ')'
                try:
                    cursor.execute(sql, values)
                    data_ids[row['id']] = cursor.lastrowid
                except:
                    print(cursor._last_executed)
                    raise
        connection.commit()
    return data_ids
        
def test_data(old, new, names, testname):
    correct_data = []
    remove_amount = 0
    for row in old:
        if row.get('customer_id') != None and row['customer_id'] == 0: 
            remove_amount += 1
            continue 
        for row_new in new:
            is_correct_data = True
            for key in names:
                if not is_correct_data: 
                    break
                if row[key] != row_new[names[key]]:
                    is_correct_data = False
            if is_correct_data:
                correct_data.append(row)
                break
    
    result = len(correct_data) == len(old) - remove_amount
    if result:
        result = "passed"
    else:
        result = "failed"
    print("Test " + testname + ": " + result)
    assert(len(correct_data) == len(old) - remove_amount)


def get_categories_from_table(tablename):
    connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='fxentxbkke',
                             cursorclass=pymysql.cursors.DictCursor)

    with connection:
        with connection.cursor() as cursor:
            sql = "SELECT DISTINCT category FROM `" + tablename + "` WHERE category != ''"
            cursor.execute(sql)
            result = list(cursor.fetchall())
            if tablename == 'types':
                result.append({'category' : 'Overige'})
            return result

def create_hoofdlijsten(categories, sublist_name, connected_ids):
    hoofdlijsten_ids = {}
    connection = pymysql.connect(host=NEW_DATABASE_HOST,
                             user=NEW_DATABASE_USER,
                             password=NEW_DATABASE_PASSWORD,
                             database=NEW_DATABASE_DATABASE,
                             cursorclass=pymysql.cursors.DictCursor)

    with connection:
        with connection.cursor() as cursor:
            for c in categories:
                current_name = sublist_name
                if c['category'] == 'Overige':
                    current_name = 'Materialen'
                sql = "SELECT * FROM `list_models` WHERE name = '" + c['category'] + " - " + current_name + "';"
                cursor.execute(sql)
                result = cursor.fetchall()
                if len(result) < 1:
                    sql = "INSERT INTO `list_models` (name, created_at, updated_at, list_model_id) VALUES (%s, %s, %s, %s)"
                    list_model_id = None
                    if current_name == 'Types' or current_name == 'Materialen':
                        if connected_ids.get(c['category']) != None:
                            list_model_id = connected_ids[c['category']]
                    category = c['category']
                    if category == 'battery':
                        category = 'batterij'
                    try:
                        cursor.execute(sql, (category + " - " + current_name, datetime.datetime.now(), datetime.datetime.now(), list_model_id))
                        hoofdlijsten_ids[category] = cursor.lastrowid
                    except:
                        print(cursor._last_executed)
                        raise
                else:
                    hoofdlijsten_ids[c['category']] = result[0]['id']
        connection.commit()
    return hoofdlijsten_ids


def import_list_values(data, category_ids, brand_ids, type_ids):
    connection = pymysql.connect(host=NEW_DATABASE_HOST,
                             user=NEW_DATABASE_USER,
                             password=NEW_DATABASE_PASSWORD,
                             database=NEW_DATABASE_DATABASE,
                             cursorclass=pymysql.cursors.DictCursor)
    new_ids = {}
    with connection:
        with connection.cursor() as cursor:
            for row in data:
                category = ''
                if row['category'] == '' or row['category'] == None:
                    category = 'Overige'
                else:
                    category = row['category']
                if category == 'battery':
                    category = 'batterij'

                values = [category_ids[category], row['name'], row['created_at'], row['updated_at']]

                sql = "INSERT INTO `list_values` (list_model_id, name, created_at, updated_at, list_value_id) VALUES (%s, %s, %s, %s, %s)"
                if type_ids != None and row['type_id'] != '':
                    type_id = int(row['type_id'])
                    values.append(type_ids[type_id])
                elif brand_ids != None and row['brand_id'] != '':
                    brand_id = int(row['brand_id'])
                    values.append(brand_ids[brand_id])
                else:
                    values.append(None)
                cursor.execute(sql, values)
                new_ids[row['id']] = cursor.lastrowid
        connection.commit()
    return new_ids

def create_inspection_template(value):
    y = json.loads(value)
    values_view = y.values()
    value_iterator = iter(values_view)
    first_value = next(value_iterator)

    template = []

    for item in first_value:
        if item == 'pos' or item == 'remarks' or item == 'yes_no' or item == 'yes-no':
            continue
        template.append({"label" : item, "type" : "text"})
    return json.dumps(template)

def convert_inspection(value):
    y = json.loads(value)

    inspection = []

    for uid in y:
        dic = y[uid]
        row = {}
        i = 0
        for item in dic:
            i += 1
            i_old = i
            value_type = 'text'
            name = dic[item]
            if item == 'pos':
                value_type = 'number'
            if item == 'yes_no' or item == 'yes-no':
                value_type = 'checkbox'
                i = "approved"
                if name == 'Ja':
                    name = True
                else:
                    name = False
            row[i] = { "type " : value_type, "value" : name }
            i = i_old
        inspection.append(row)
    return json.dumps(inspection)
    


def insert_inspections(data, customer_ids, location_ids):
    connection = pymysql.connect(host=NEW_DATABASE_HOST,
                             user=NEW_DATABASE_USER,
                             password=NEW_DATABASE_PASSWORD,
                             database=NEW_DATABASE_DATABASE,
                             cursorclass=pymysql.cursors.DictCursor)
    inspection_types = {
        "blusmiddelen" : 1,
        "keerkleppen" : 2,
        "noodverlichting" : 3,
        "noodverlichting2" : 3
    }
    with connection:
        with connection.cursor() as cursor:
            for row in data:
                if(row['json'] == None or row['json'] == '' or row['json'] == '{}'):
                    continue
                template = create_inspection_template(row['json'])
                template_id = 0

                search_template_sql = "SELECT * FROM templates WHERE json = '" + template + "'"
                cursor.execute(search_template_sql)
                result = cursor.fetchall()
                if len(result) > 0:
                    template_id = result[0]['id']
                else:
                    insert_template_sql = """INSERT INTO `templates` 
                    (inspection_type_id, json, created_at, updated_at) 
                    VALUES 
                    (%s, %s, %s, %s)"""
                    values = (inspection_types[row['category']], template, datetime.datetime.now(), datetime.datetime.now())
                    cursor.execute(insert_template_sql, values)
                    template_id = cursor.lastrowid

                # The template has been found or created
                # Now let's insert the inspection
                insert_inspection_sql = "INSERT INTO `inspections` (user_id, customer_id, location_id, template_id, json, locked, created_at, updated_at, deleted_at) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                if customer_ids.get(row['customer_id']) == None or location_ids.get(row['location_id']) == None:
                    continue
                values = (2, customer_ids[row['customer_id']], location_ids[row['location_id']], template_id, convert_inspection(row['json']), None, row['created_at'], row['updated_at'], row['deleted_at'])
                cursor.execute(insert_inspection_sql, values)
        connection.commit()  

################### INSERTING DATA ###################

##### Customers #####
customer_names = { 
    'name' : 'name',
    'city' : 'city',
    'street' : 'street',
    'housenumber' : 'number',
    'postalcode' : 'postal_code',
    'phone1' : 'phone_number',
    'contactperson' : 'contact_name',
    'phone2' : 'contact_phone_number',
    'email1' : 'contact_email',
    'created_at' : 'created_at',
    'updated_at' : 'updated_at',
    'deleted_at' : 'deleted_at'
}
customer_ids = insert_data(gather_old_data('customers'), customer_names, 'customers')
print('Converted customers: done')

##### Locations #####
location_names = {
    'created_at' : 'created_at',
    'updated_at' : 'updated_at',
    'deleted_at' : 'deleted_at',
    'name' : 'name',
    'city' : 'city',
    'street' : 'street',
    'postalcode' : 'postal_code',
    'housenumber' : 'number',
    'contactperson' : 'contact_name',
    'phone1' : 'phone1',
    'phone2' : 'phone2',
    'email1' : 'email1',
    'email2' : 'email2',
    'comment' : 'comment',
    'customer_id' : 'customer_id'
}
l_i = -1
location_old_data = gather_old_data('locations')
for row in location_old_data:
    l_i += 1
    if customer_ids.get(int(row['customer_id'])) == None:
        location_old_data[l_i]['customer_id'] = 0
        continue
    location_old_data[l_i]['customer_id'] = customer_ids[int(row['customer_id'])]
location_ids = insert_data(location_old_data, location_names, 'locations')
location_names.pop('customer_id')
print('Converted locations: done')

##### Users #####
user_names = {
    'created_at' : 'created_at',
    'updated_at' : 'updated_at',
    'deleted_at' : 'deleted_at',
    'name' : 'name',
    'first_name' : 'first_name',
    'last_name' : 'last_name',
    'remember_token' : 'remember_token',
    'role' : 'role',
    'customer_id' : 'customer_id',
    'email' : 'email',
    'password' : 'password'
}
l_i = -1
user_old_data = gather_old_data('users')
for row in user_old_data:
    split = row['name'].split(' ', 1)
    row['first_name'] = split[0]
    lastname = ''
    if len(split) > 1:
        lastname = split[1]
    row['last_name'] = lastname
user_ids = insert_data(user_old_data, user_names, 'users')
print('Converted users: done')

##### Inspections #####
inspection_data = gather_old_data('reports')
insert_inspections(inspection_data, customer_ids, location_ids)
print('Converted inspections: done')


##### Brands #####
brand_hoofdlijsten_ids  = create_hoofdlijsten(get_categories_from_table("brands"), "Merken", None)
brand_ids               = import_list_values(gather_old_data('brands'), brand_hoofdlijsten_ids, None, None)
print('Converted brands: done')

##### Types #####
type_hoofdlijsten_ids   = create_hoofdlijsten(get_categories_from_table("types"), "Types", brand_hoofdlijsten_ids)
type_ids                = import_list_values(gather_old_data("types"), type_hoofdlijsten_ids, brand_ids, None)
print('Converted types: done')

##### Materials #####
material_hoofdlijsten_ids = create_hoofdlijsten(get_categories_from_table("materials"), "Materialen", type_hoofdlijsten_ids)
material_ids                = import_list_values(gather_old_data("materials"), type_hoofdlijsten_ids, brand_ids, type_ids)
print('Converted materials: done')

################### TESTING DATA ###################
test_data(gather_old_data('customers'), gather_new_data('customers'), customer_names, 'customers')
test_data(location_old_data, gather_new_data('locations'), location_names, 'locations')
test_data(user_old_data, gather_new_data('users'), user_names, 'users')