# ગુજરાતી બિલિંગ અને રિપોર્ટિંગ (PHP + MySQL)

સરળ ડેસ્કટોપ-સ્ટાઇલ વેબ એપ્લિકેશન (PHP builtin server થી ચલાવો) જે પ્રોડક્ટ, ગ્રાહક, ચાલાન, GST બિલ અને માસિક રિપોર્ટ મેનેજ કરે છે.

## આવશ્યકતાઓ
- PHP 8.1+
- MySQL 8+

## સેટઅપ
1. `.env` નથી; `config/config.php` માં DB સેટિંગ બદલો અથવા Env Vars વાપરો:
   - `APP_DB_HOST`, `APP_DB_PORT`, `APP_DB_NAME`, `APP_DB_USER`, `APP_DB_PASS`
2. ડેટાબેસ બનાવો અને સ્કીમા ચલાવો:
   ```sql
   CREATE DATABASE gujarati_billing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
   પછી
   ```bash
   mysql -u root -p gujarati_billing < database/schema.sql
   ```
3. PHP સર્વર ચલાવો:
   ```bash
   php -S 127.0.0.1:8080 -t public
   ```
4. બ્રાઉઝર ખોલો: http://127.0.0.1:8080

## મોડ્યુલ્સ
- પ્રોડક્ટ્સ: શોર્ટ કી, નામ, ભાવ, મજૂરી, HSN, GST ટકા
- ગ્રાહકો: નામ, ફોન, સરનામુ, GSTIN
- ચાલાન: યુનિક નંબર, તારીખ, ગ્રાહક, લાઇન આઇટમ્સ (qty, ભાવ, મજૂરી, GST)
- GST બિલ: ચાલાન પરથી જનરેટ; CGST/SGST ગણતરી
- રિપોર્ટ્સ: માસિક GST બિલ યાદી, માસિક ચાલાન, ગ્રાહક મુજબ ચાલાન

## નોંધ
- યુનિક નંબરો `sequences` ટેબલથી મેનેજ થાય છે.
- UI ગુજરાતી લોકેલ સાથે છે; ટેક્સ્ટ `locales/gu.php` માં છે.
- પ્રિન્ટ વ્યૂ માટે `window.print()` અને print CSS લાગુ છે.
