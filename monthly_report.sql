PGDMP                          |            monthly_report    10.6    10.6 U    e           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            f           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            g           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            h           1262    18211    monthly_report    DATABASE     �   CREATE DATABASE monthly_report WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE monthly_report;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            i           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            j           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    18212    kolom_attributes    TABLE     �   CREATE TABLE public.kolom_attributes (
    id bigint NOT NULL,
    user_id bigint,
    report text,
    sub_report text,
    status text
);
 $   DROP TABLE public.kolom_attributes;
       public         postgres    false    3            �            1259    18218    kolom_attributes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.kolom_attributes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.kolom_attributes_id_seq;
       public       postgres    false    196    3            k           0    0    kolom_attributes_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.kolom_attributes_id_seq OWNED BY public.kolom_attributes.id;
            public       postgres    false    197            �            1259    18220    kolom_values    TABLE     �   CREATE TABLE public.kolom_values (
    id bigint NOT NULL,
    kolom_id bigint,
    value text,
    periode date,
    satuan text
);
     DROP TABLE public.kolom_values;
       public         postgres    false    3            �            1259    18226    kolom_values_id_seq    SEQUENCE     |   CREATE SEQUENCE public.kolom_values_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.kolom_values_id_seq;
       public       postgres    false    3    198            l           0    0    kolom_values_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.kolom_values_id_seq OWNED BY public.kolom_values.id;
            public       postgres    false    199            �            1259    18228    log_data    TABLE     �   CREATE TABLE public.log_data (
    id bigint NOT NULL,
    user_id bigint,
    activity text,
    date timestamp without time zone
);
    DROP TABLE public.log_data;
       public         postgres    false    3            �            1259    18234    log_data_id_seq    SEQUENCE     x   CREATE SEQUENCE public.log_data_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.log_data_id_seq;
       public       postgres    false    3    200            m           0    0    log_data_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.log_data_id_seq OWNED BY public.log_data.id;
            public       postgres    false    201            �            1259    18236    menu    TABLE     Y   CREATE TABLE public.menu (
    id integer NOT NULL,
    menu text,
    link_href text
);
    DROP TABLE public.menu;
       public         postgres    false    3            �            1259    18242    menu_id_seq    SEQUENCE     �   CREATE SEQUENCE public.menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.menu_id_seq;
       public       postgres    false    3    202            n           0    0    menu_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.menu_id_seq OWNED BY public.menu.id;
            public       postgres    false    203            �            1259    18244    report_access    TABLE     g   CREATE TABLE public.report_access (
    id bigint NOT NULL,
    user_id bigint,
    kolom_id bigint
);
 !   DROP TABLE public.report_access;
       public         postgres    false    3            �            1259    18247    report_access_id_seq    SEQUENCE     }   CREATE SEQUENCE public.report_access_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.report_access_id_seq;
       public       postgres    false    3    204            o           0    0    report_access_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.report_access_id_seq OWNED BY public.report_access.id;
            public       postgres    false    205            �            1259    18249    satuan    TABLE     ]   CREATE TABLE public.satuan (
    id integer NOT NULL,
    satuan text,
    user_id bigint
);
    DROP TABLE public.satuan;
       public         postgres    false    3            �            1259    18255    satuan_id_seq    SEQUENCE     �   CREATE SEQUENCE public.satuan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.satuan_id_seq;
       public       postgres    false    3    206            p           0    0    satuan_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.satuan_id_seq OWNED BY public.satuan.id;
            public       postgres    false    207            �            1259    18257    user    TABLE     �   CREATE TABLE public."user" (
    id integer NOT NULL,
    nama text,
    nik text,
    username text,
    password text,
    department_id bigint,
    sub_department_id bigint,
    role_id bigint,
    status_periode bigint
);
    DROP TABLE public."user";
       public         postgres    false    3            �            1259    18263    user_access_menu    TABLE     j   CREATE TABLE public.user_access_menu (
    id integer NOT NULL,
    role_id bigint,
    menu_id bigint
);
 $   DROP TABLE public.user_access_menu;
       public         postgres    false    3            �            1259    18266    user_access_menu_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_access_menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.user_access_menu_id_seq;
       public       postgres    false    209    3            q           0    0    user_access_menu_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.user_access_menu_id_seq OWNED BY public.user_access_menu.id;
            public       postgres    false    210            �            1259    18268    user_department    TABLE     e   CREATE TABLE public.user_department (
    id integer NOT NULL,
    department text,
    kode text
);
 #   DROP TABLE public.user_department;
       public         postgres    false    3            �            1259    18274    user_department_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_department_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.user_department_id_seq;
       public       postgres    false    3    211            r           0    0    user_department_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.user_department_id_seq OWNED BY public.user_department.id;
            public       postgres    false    212            �            1259    18276 	   user_role    TABLE     J   CREATE TABLE public.user_role (
    id integer NOT NULL,
    role text
);
    DROP TABLE public.user_role;
       public         postgres    false    3            �            1259    18282    user_role_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.user_role_id_seq;
       public       postgres    false    3    213            s           0    0    user_role_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.user_role_id_seq OWNED BY public.user_role.id;
            public       postgres    false    214            �            1259    18284    user_sub_department    TABLE     �   CREATE TABLE public.user_sub_department (
    id integer NOT NULL,
    sub_department text,
    department_id bigint,
    role_id bigint,
    kode_dept text
);
 '   DROP TABLE public.user_sub_department;
       public         postgres    false    3            �            1259    18290    user_sub_department_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_sub_department_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.user_sub_department_id_seq;
       public       postgres    false    3    215            t           0    0    user_sub_department_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.user_sub_department_id_seq OWNED BY public.user_sub_department.id;
            public       postgres    false    216            �            1259    18292    users_temp_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_temp_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_temp_id_seq;
       public       postgres    false    208    3            u           0    0    users_temp_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.users_temp_id_seq OWNED BY public."user".id;
            public       postgres    false    217            �
           2604    18294    kolom_attributes id    DEFAULT     z   ALTER TABLE ONLY public.kolom_attributes ALTER COLUMN id SET DEFAULT nextval('public.kolom_attributes_id_seq'::regclass);
 B   ALTER TABLE public.kolom_attributes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196            �
           2604    18295    kolom_values id    DEFAULT     r   ALTER TABLE ONLY public.kolom_values ALTER COLUMN id SET DEFAULT nextval('public.kolom_values_id_seq'::regclass);
 >   ALTER TABLE public.kolom_values ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    199    198            �
           2604    18296    log_data id    DEFAULT     j   ALTER TABLE ONLY public.log_data ALTER COLUMN id SET DEFAULT nextval('public.log_data_id_seq'::regclass);
 :   ALTER TABLE public.log_data ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    201    200            �
           2604    18297    menu id    DEFAULT     b   ALTER TABLE ONLY public.menu ALTER COLUMN id SET DEFAULT nextval('public.menu_id_seq'::regclass);
 6   ALTER TABLE public.menu ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    203    202            �
           2604    18298    report_access id    DEFAULT     t   ALTER TABLE ONLY public.report_access ALTER COLUMN id SET DEFAULT nextval('public.report_access_id_seq'::regclass);
 ?   ALTER TABLE public.report_access ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    205    204            �
           2604    18299 	   satuan id    DEFAULT     f   ALTER TABLE ONLY public.satuan ALTER COLUMN id SET DEFAULT nextval('public.satuan_id_seq'::regclass);
 8   ALTER TABLE public.satuan ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    207    206            �
           2604    18300    user id    DEFAULT     j   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.users_temp_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    217    208            �
           2604    18301    user_access_menu id    DEFAULT     z   ALTER TABLE ONLY public.user_access_menu ALTER COLUMN id SET DEFAULT nextval('public.user_access_menu_id_seq'::regclass);
 B   ALTER TABLE public.user_access_menu ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    210    209            �
           2604    18302    user_department id    DEFAULT     x   ALTER TABLE ONLY public.user_department ALTER COLUMN id SET DEFAULT nextval('public.user_department_id_seq'::regclass);
 A   ALTER TABLE public.user_department ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    212    211            �
           2604    18303    user_role id    DEFAULT     l   ALTER TABLE ONLY public.user_role ALTER COLUMN id SET DEFAULT nextval('public.user_role_id_seq'::regclass);
 ;   ALTER TABLE public.user_role ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    214    213            �
           2604    18304    user_sub_department id    DEFAULT     �   ALTER TABLE ONLY public.user_sub_department ALTER COLUMN id SET DEFAULT nextval('public.user_sub_department_id_seq'::regclass);
 E   ALTER TABLE public.user_sub_department ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    216    215            M          0    18212    kolom_attributes 
   TABLE DATA               S   COPY public.kolom_attributes (id, user_id, report, sub_report, status) FROM stdin;
    public       postgres    false    196   �W       O          0    18220    kolom_values 
   TABLE DATA               L   COPY public.kolom_values (id, kolom_id, value, periode, satuan) FROM stdin;
    public       postgres    false    198   �^       Q          0    18228    log_data 
   TABLE DATA               ?   COPY public.log_data (id, user_id, activity, date) FROM stdin;
    public       postgres    false    200   ˆ       S          0    18236    menu 
   TABLE DATA               3   COPY public.menu (id, menu, link_href) FROM stdin;
    public       postgres    false    202   u�       U          0    18244    report_access 
   TABLE DATA               >   COPY public.report_access (id, user_id, kolom_id) FROM stdin;
    public       postgres    false    204   )�       W          0    18249    satuan 
   TABLE DATA               5   COPY public.satuan (id, satuan, user_id) FROM stdin;
    public       postgres    false    206   L�       Y          0    18257    user 
   TABLE DATA               ~   COPY public."user" (id, nama, nik, username, password, department_id, sub_department_id, role_id, status_periode) FROM stdin;
    public       postgres    false    208   �       Z          0    18263    user_access_menu 
   TABLE DATA               @   COPY public.user_access_menu (id, role_id, menu_id) FROM stdin;
    public       postgres    false    209   ��       \          0    18268    user_department 
   TABLE DATA               ?   COPY public.user_department (id, department, kode) FROM stdin;
    public       postgres    false    211   ݛ       ^          0    18276 	   user_role 
   TABLE DATA               -   COPY public.user_role (id, role) FROM stdin;
    public       postgres    false    213   ��       `          0    18284    user_sub_department 
   TABLE DATA               d   COPY public.user_sub_department (id, sub_department, department_id, role_id, kode_dept) FROM stdin;
    public       postgres    false    215   =�       v           0    0    kolom_attributes_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.kolom_attributes_id_seq', 260, true);
            public       postgres    false    197            w           0    0    kolom_values_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.kolom_values_id_seq', 1925, true);
            public       postgres    false    199            x           0    0    log_data_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.log_data_id_seq', 1180, true);
            public       postgres    false    201            y           0    0    menu_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.menu_id_seq', 9, true);
            public       postgres    false    203            z           0    0    report_access_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.report_access_id_seq', 785, true);
            public       postgres    false    205            {           0    0    satuan_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.satuan_id_seq', 22, true);
            public       postgres    false    207            |           0    0    user_access_menu_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.user_access_menu_id_seq', 17, true);
            public       postgres    false    210            }           0    0    user_department_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.user_department_id_seq', 20, true);
            public       postgres    false    212            ~           0    0    user_role_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.user_role_id_seq', 3, true);
            public       postgres    false    214                       0    0    user_sub_department_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.user_sub_department_id_seq', 17, true);
            public       postgres    false    216            �           0    0    users_temp_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.users_temp_id_seq', 20, true);
            public       postgres    false    217            �
           2606    18306 &   kolom_attributes kolom_attributes_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.kolom_attributes
    ADD CONSTRAINT kolom_attributes_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.kolom_attributes DROP CONSTRAINT kolom_attributes_pkey;
       public         postgres    false    196            �
           2606    18308    kolom_values kolom_values_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.kolom_values
    ADD CONSTRAINT kolom_values_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.kolom_values DROP CONSTRAINT kolom_values_pkey;
       public         postgres    false    198            �
           2606    18310    log_data log_data_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.log_data
    ADD CONSTRAINT log_data_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.log_data DROP CONSTRAINT log_data_pkey;
       public         postgres    false    200            �
           2606    18312    menu menu_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.menu DROP CONSTRAINT menu_pkey;
       public         postgres    false    202            �
           2606    18314     report_access report_access_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.report_access
    ADD CONSTRAINT report_access_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.report_access DROP CONSTRAINT report_access_pkey;
       public         postgres    false    204            �
           2606    18316    satuan satuan_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.satuan
    ADD CONSTRAINT satuan_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.satuan DROP CONSTRAINT satuan_pkey;
       public         postgres    false    206            �
           2606    18318 &   user_access_menu user_access_menu_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.user_access_menu
    ADD CONSTRAINT user_access_menu_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.user_access_menu DROP CONSTRAINT user_access_menu_pkey;
       public         postgres    false    209            �
           2606    18320 $   user_department user_department_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.user_department
    ADD CONSTRAINT user_department_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.user_department DROP CONSTRAINT user_department_pkey;
       public         postgres    false    211            �
           2606    18322    user_role user_role_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.user_role
    ADD CONSTRAINT user_role_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.user_role DROP CONSTRAINT user_role_pkey;
       public         postgres    false    213            �
           2606    18324 ,   user_sub_department user_sub_department_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.user_sub_department
    ADD CONSTRAINT user_sub_department_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.user_sub_department DROP CONSTRAINT user_sub_department_pkey;
       public         postgres    false    215            �
           2606    18326    user users_temp_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT users_temp_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public."user" DROP CONSTRAINT users_temp_pkey;
       public         postgres    false    208            M   �  x���Ms�6��į�)�^\��v'��Ǝ5��X�%�$��w�� $�@��/m,>�X-^bw!��C|�g/˼�*��bU]:��ر�g�sÖU^��9�؊��bq�*r�Bv_�/��L�,�+�:�K��2�c����g[�.�kV��
`l�j�M���5Ϫ"߂���E�g`� �m)[6d,��N˪H�k�:bی�|x�to��4qK3Xʕ!:s��N��^�cn�NP?�x����#���;g�ƽ�|���|�~��L��߽�+��z����,��|}�;�ӛ��p�����s���|������z	w�����^��2EoԶ#�ިm3zz����5BO�s�����IA��&:��A��i�k,OkQ��W�up~|4��Tk�[b>`t8���;P�)���"KX
��$�Bi���#C�C쿑�vK�0Op��POH��t����9�ܜ
�v{�H%��������@�Qw����׃�q%�X��?/2ԤG	Jh��ׅ,l]�J���!z��%� s|���8��I2�P��]4�ÃXW��`�W���Rǐ�0����J�F��3�D�s��Og��Rkpl;�z���q���O'��m�T6�U=�rd�Xc�W���V�U81��g��=�x���b�������P�HӠ��@m������c�]}y|��	V���t������]���GkC����X5���.+�e��g_���--��&�fT�d"�%��jqOS���AK5Va����6���03|��7�[�N����4�iV�eK�����e�e���Ŧt�a��� �~��"8��|c��"���B��,s���`0�)���Y��J�m Y�D��h�J��x�$.m�&�6
'H
W�y�� �lŷ5Xfj�K�H��t�(	w%���L��K�8�(�q���8^�t�h4�Oơ������/�Y�����
/�]J�A�Ik`4���*^�&��wo�ԽL�
������8����4껺���-.Jr|��������f�'}����>�G�K�[}ݳK���t%�t��+�>�됮�O�����Z�׻-_0Ёq��><����(����:�����귔�Q�����>�k�e���������D�,{�S8�ŗ�K�~�\YE��g0�^�Ϡ�AϨ���K	�ռ��M���5�g߅L1+�S@Z��مBj����`*��#�E���m���g%ː���[��*�f��V�{ m������LS����q�$&�ay�Ľ�01]�M��"n���C\0#�5/���~��g��!/1^v�fb�	RP��BY�~Z�x�A��M6�zdT[г\��fk�����,���bKoe��jy����p�P�{�������e��Ӭ�D'�?��[��hh+V���e�+[V�h��I�'JGN��Tr���r �˥(��!���_�38C��ixr �:��߇'�vC��O�pl�d��S}<���G,EgCgs�������¤�9�����q"b�$A��*_ߤ>��"\�$;��"YjҜƶ+5	N�h#Sj��J(5�Kcۗ&5	Lc-DIM�����H'jI"ƶ{g�N|�m9�����t|-��Zæ�"8�>}!�����G��#����_��l	���M�F��?�yQ�;~L������w������fo���w���JG�      O      x���M���m�מ�ҩ%Q_��(R�馛,m�$H;����sl�2�xV�u,Y�(R�,�c�!=���gҿ����|�z��s�A9f;J{9f?�|�z�q����s��_-�<�$�r���|`���������Dr�WI7JhD*3@͐��A+�����V��T�%�?@�����hI��[���<�?�J��4m<��Lg	��hH@�5r#��������}@.�L'����v�ǿZq>�=ъ����M��v��T�L-��_Ђ�oy�	ڐR	P5�8�L�3���4�oEd.���I�����=��v!3�4G��������z��f���rn�,�?���~��9����@s.��X��������_�.O���YPe�܀���?�=o��?��/����o?�a��!��������~jZ�:����N�0��eH-_G�<����D%��O��B�����Q!|?����@��Bw��,2F� �0t*3@*D���WPA��廾Bv��#��J%�I�J��:b�dɎL"�&�$RID�#�Hw� �S45`�%���y(d>` ��A��B3��h��Dя��N�bD��dͺ�'ڙ�Y-BŚ�k���}�i%@�%�֨�~j�'s�j�g���
ڪK֮��t���d��P�Uk[X[���ָL.�ˆ�-�ͥ� �x\9����6"��i)Be�-BBM#T����KV��MB֗������"4�<�Ok]�P��I�2��P��y�/\c��bk)Z�H��g	�9Н��Q$*��0Bh�#��/̬9bk$�1��Zc�h-��4Gh'�S<�B�nGGqIB����c��`�M*4?�`�O�Z���<	\�-B�wH��c�}D�KB0Z�x'	\�X1m
}|��#l<b*qC31�6<G����Z2��6=���H�� L�J�]�E�5Fs8=�8�E�����2Ŝ���-B�Q'��a'��q'�΁'���'�ɡ�g��ؓX���X^�g��Z~�e
ş�*+��1��e��b�:c%4�X=B�ꌕP"c%��X�0*!~u�JH�X	�e�a�mk�h�0֨� ���Jl.c��Xo�����:c%T��^ݒ����l��+�N�Jh����X�"3�Yo��+���J���6Vb���Xcc%��X�2VB���#ĳf�Aԝ�Ƚg%��X�7AD댕����f��HR#�J���d��&{V�̢E/�h����5,��g%&�X�2+�x��X	����6Vb���3D��X	%2VB���Xa�JL�X�U6Vb���Xgc%6��F�DH��3��X�%6Vb���P!c%$�XGXdec%�ȳ�d��+�I��Z�Y	%2VB���Pac%&l��*+���J���l��8���|yK���]����gLu�7�:#ƩWB����'�L��7�̃�~%��_=��Ķ,�O
6�x�o6z�=	Kl���4,�N�Jh,c푨-�u�N�,���Vgm�Q�0��������jd��:+���Jlr왅�5��Y�+d��#!c%T��^FG����l��+�I��P�p�+���5hB�p�+���JL�X�U6Vb���X_�d�
�ټ/�}�dc���i�$N0�$���`ac%�	&B�`"�	&B�<+��`
_�LeN0J<g%��X�6Vb��JlK0�L�8�T=��O��y�RN6Vb���'�q��Ж`"Vٳ�LĶ�-�DlK0y&'��Ķ���J����!N0�&�"�Hgc%6h�J�LUN0��LsVB�`"�	&B�S��S�`"�I0�/�I0�lK0y�>	�1*�
jA8+�uA4[�yA0[�yA0[�%��`V"}�n�(ek�?� ��~� !�U1y�8V��M`}Ip���vA�by ���#��#��P!K�����A������A���JL_���1,�!���9�lm�Ty�� ���#7$1Rq��#!"��-|
lד
�W�qT �W�q	�\
�W9B���D�N�h� xUGo
��7��pۿ�a�c��Q���bWe�h�}
gX� t��Q�m*	;��Α���vA؊���;�@f�Q��0x��u�����JEm�[��X\��@����K��%܅#��c�X�V�`{���hGX ���]Q���Vfa�+����1�;J�ҧh e�!�*qm*��<�a���jbAZ������D�5\��5\��5\�DP�{��=	5�:yOB��'�I��#���#X(Ī-�BU�=	�dy���@�X �T[��)�E��0�{Ob���G�S��$��{��=	򞄄�'�JޓP3�,�
�T�=	�&yO��z�I,��$��{*�=	��ae���P#�J��c%6ȱ��X=B��+�Ď�X&�J��c%$�X	Ur���r��@�θ� Fu���d��z k�9VB�+��k4^a�J��c%�ȱ��X	v��&9V��I��Pb�J,�c%Vȱr���r�Q��}�w��:y��� �Ih��t���p�"P��zE��'�Bޓ���$T�{j�=	u�9HB��GS��$�xzI,��$T�Ar���r�����j�@Ej�9HB�$�I�#�V{��Zu�P&I���$$� 	Ur��9HB}9Ȩ{X�zƕMr�!@u�PbI,��$T�Av��*9HB�$�N��`Il���1��"��D�3�"T?�$&� 	Ur��;Hb}9Ȩ�� Ih�������T�&�2yABż`��*��Ur���AB}����n��$7��I:7H(�$���l����TD����	5r��:�AB�� �In�#K����%S[���Z2�Gۓ*�a�	�M"�_X�Gj�#	u��Hb�|�G�L7�T˥��\jw�T$S[�?0;I���$��G��#	�&�H�,�Z��EՒ��W6Ւ��^��a��HB�>�X%I���$��G�#�M�5˥֨����Hb�|$�B>����$T�Gk�#	u��HB�|�G�Ku>�X"I(��$T�GF���3�N�,���f���֗��`�Il����fm��4+ꥋ�ҟs��
�OBB�Pe�I���$��}�>	Mv��A��}����`�LB��I�W0	�
&!^�$�+��x�#Y+���}�����7��`�`��	�`�LB��Ih[�$�+��x��`zT�Lb��I�W0	�
&!^�$�+��x��`�>	�
�G�W0	�
&�m��`�LB��I賂�N�� �Ih���̲�=,Qꈻ�T�>	v�Ą�'�J�P#�I���$4���$��%So�I(-�>��}+�>		�OBu�ϨX2��[Z�eSc�X656K���d�,����5��|��6;�`��Y2�%a��r�a���'�F�Pg�Ilp�/a�]���%LB��I��0	�&!^�$�K��x	�/a�>	Mr�����_��K��x	�/av��x	�/a�%LB�%�`�uO���Q�%LB��I��0	�&!^�$�K��x	�/a�%LB���Q9y�I��0	�&!^�$�-a�%LB��Ih[�$�K��x	�#�%LB�&1^�$�K��x	�/aj<�$�K���f�eD���ӳz��$�K��2�OB��'1a�I��0	�&����g3�Z��0=j��Ih[�$��}�5LB��Ih[�$�x�I��0�G��I��0=꼆I��0	�&!^�$�k��x�P#�I���$4>�3,r������p@(��$��}+�>		�OB��'���X'�Ih��$4�}zd	ոXB5��P-a]�P�	�OB��'�F�P'�Ih,��˧�Qe��)*q F�~���tj	?��O�1,�Z��*�Ob��'�N�� �Ih�������˧��cX>5���<l�t;��Ur���OB����/p��>=2r�OB��'���X!�IH�}F�j��$��}��>	r��&'o�ȿ��'�D�P&�I���$&�>�ՏW�G�;�~�w�5��/��S����?���v2B�����~0W�4|ٴ~1�/0<��,+;�?H'� ����i��D?����^j�o	�~��x�    ���6�N��u���:��y!�|�Bh��T�)=q�`�g�%�r�PHf������f�U�Xw�
&�f��c�i�@/o�%DRY[|w� ��G��\�����'0���g5��6�
b`��u�(����I�5�J�=�u��i&>;�h�j�IOJ��@A�ėNu�<�]?(`5 ���]A���F�#�H-�9�
i�#h�,58*gl����l{�.�="���	��G$�^="jpd�~Q�9#!w;m(r�	d�-��Kz�&]]W-ᐄ`	C:�:�`���L�)�*�^::t�D�a�~�х*��^x���m5����x?�C.d�R{M��1_?�����]	:�|�[4���*4���s��b�G�S��Yg����Y8>�}���X8�<�}�c?9�B��ϩ���G�_$>e?O�,R�
���Hg
��؉�	���FXB$=���K~"�*�L�J�:P��H~j��?Ј2���[��R�Q%L��ž�>c�<5�*%T�L�#�B2Q�Z{K#RC�,�Y�/���k�����_~������ڼ<����=��O�{v��Q����ޯ<M�d��A�Q���i٩��e��z��
<m�ٶ����P�^�|�y|�v��o�o�k��EZP�tt�d�U��EE��������v�g�y�=ݵPƱ��ɪ�hAN��.g���-�����)��]�o�Ђ����.I���o=�~ڦ��؏�sT���<1Oӱ��i>��<-�~����ŋ���ݵ�1����@�W�_mA���ه����l籟3�i����򱟤�i���Zh�鮅f��/Zh��]Έ��누�|�s�t�u�h�EZ@�>^����j��ǫ��W[@�>^���}��B�W�-��ݵ���F$���uDB�>_��h}����:"!\�����}�z�agҼ�D��ǋ��쮅1��
�0OOw-��K޵0�v��\��ω'.�:�ܜ�Uؕ�ΑN���x)9�r���ԞOR��xE�!
[5�[�?��Nxk�_-��yܿH��ZðU`����OR���hMN���b4�SV����i%�A;$�r���N<�jG0����Q>�H;:[>]�e���/V��|��߬X�]j�P�ȱ��{�z��pެ�����ԏ�X���c?��f_�׳��Rҩq=��JE^���	@n���c�4�j�����}��l��X!��F�5Ҋ�����s��EC}�Qz�n�a�h�o[��,��M��Y�EC������d)���9�y��tU�tU�G�*�G�*�]W��@We�@We�HWr�@W�~�+�?ҕ��J���	���l?hkA��QN�	���_F9�)X��r����c��	���)e����Ж򢰺�|��
��t�y:sP6ڛ�K�I\:�UU�^k���M�*�E 3�ǛYaMK��曦�Rl���U�t=f�7M�B�Ũ��A�X?:�@�3��HA'��ڿ���S�q%No)��oj&��ƛ�ڼ^���n�k��ѩ�֖^T�C v����t�3���r��"l�'VvM`<�/v�s����T75�tC�k�Ǔ��aU���EOU/V�s���MG�ĘʘoJ&G9߬h_;�@g��xӑ�=�zY�7��C�5^{Q��@0\�`��!��H{1��H{1���}?y����A��SyQ�NC�������MZN�M#Ӥ&u�hd6_8K����mD���]Z<��L�쪖��S�/#.����K�z�E\v��뱻��>+-�<��FrC�VB�B��ew������i��SR� ��e+��MEX����!�7f�!\�e7����"�k�@�x��u_�Ճ��4f7e�b:2��A8�w?k�f��S
��<g�����Ӓx�C�A�xV���t�A�,�ϛ�,-b�`*2�O�7�`*b�X��t��r"�B�d�޺��_��<zm���P�"S]~/�#�QE�#N�\`kFK�o��Woa	F=�%�%K�����K�j^Cb}�LD0f�}�tD�r���;�cf��P_8��6i�9b�!���l��
���>�q,�Pa6����[�J�p�0~�u��bP����­*	��/+�9[�31y�<����1{�*ML�5ՖZ�3��\���*͞Gr'�+S�]G2�ej���v��5)yhM'%�5��B���+&Z�)�X�jK=_�:l�ƛjS���ӓj�H�)ԛNOP�6f��Z5��ҪĊk&����O�"ŵ%S�����_d|ZQ�H5�6����{�fYo:Y�lq������4D^���Ֆ�^G�����������X���Ce:]�����i��Yņn����E_�$���κI���Yt�d+�v���ny�)�eh�)~�߲����fc:e��[6ce���\
dS������E��|������-|Q���-ԉ��`��2���p���z�a��w�/�&�y����a����5�nK���居�o?�Е�f]-,�P������鏞n�K~������]�����p�e��<��:�\0��w7s
�f�Z�#B_�D�k�-�N+���z��_S}�X��B��*1<�Cu`+)��ڧ:p�
��P�[e�׫�5RnX��6���O�c�����͗T�S:]Xk�u��Ӈ�P�e���%5i�6�;��%�ғ��TI2�%�'�$�֨9ֈ:,d��>p	ܰ��z}�\����#c�?Ƌ6��Jۋ24B�1#�X��.�_V�K�<���n��S�S�X��=l�x��"�	����3?Q��^����3�r�I�p6�{�
�T�F3��=��X䔡+���60�<zu`.`�3��:��?=���E�C���Z�^�p��s��%4��52YBS�����Kh��A�o������հ@3@�0���%��(^�L{�zq@��|�� �@�#1(h)gk�о��弽uky:i�"����������!�&G���S�]���-s�$f��vQ"��vU�.K���3$L�Ӿbۥ�H�s��&N������ٖ��E����E�������v��C��<���$N�̇05
n6��e����k�H����>ȇ$�C*�!H���]���?�%)kw�cUY?�C��Z>�!D59�1�|Q�`�!j_ �!j�
PR��u̇�0�R���z+��<� �~B����?Ĩ�o3��qZ��u�qZ������>��1���9�S��t���|�R�[Ec}����&�5���̵���|�K\���/�/��c��.V\���2�>v��k[돑W��-e<�N\���C��ce]~:��;V���3.Y���f�9?�ܴ��RD��ܶ�3�S�3<��+�N��3>��+ͮ&ssV �{p���*�E����~u
pڧ��|����~�.cY�}�Ғ�a�.K~��-�c<����]�@w����j���pA�L�e�4�Z���?���m�o�4;*��V��ٯ�}h�g��A�v}h[�v)ߘ�:ڭ��_���a4!��{ԇ�oɉ���0�Y��ɇ��l������KV�_�{%'��d5F�~��X�ƾ)O1k��r�9�RV� �h��ᅬ��kQF}��V���=aq��:?��?%�}��<����$+vt9��ոՊ�u>ūm�'�}�tm�	˒��ډL�C��5;�]�uv���CR/[�a�ݑ�l��ӭY�S�XA������x
W�fg$H{
�r��Vp�S��ڵ�9��p����#�S��x�s�A׭KD���)�j"�g
�-���ș�"�>|��,[D#���`t@H�u�z��t�`ZV�5�8�"6�XO�J�t���:�x�QJ_5���9J `�+x�#���̋�Q��;�*y�hp@�{S�{�!dD0�mp@�O�s.O#��i�yiǉq̀��S�dP�\L��E �l�<ċ;8P���..�R���5x�|��I�p���rE�R��w)�I�u��g�Q	n�h�	���Bh�N]� �����	�A��ѻ �  �B�^�pg]���Y�!(n��X���ݡ�c\��{u��Hg=��n����{�/��������a������ȣ��4�@t;��|���8 ���ޥ��>߻��J���X'{��O�,�=�]}�����qD���ǻ��@�S�*Q|�r��7��8�c�/�M_��?E�O�);���A�#��{:�ϧ� ��x<S�Z�ap�C�5R�Å�BWb�V[�t3r���SO��y�pۃ���%��c�@����ȹ���[y�����������W�y��h�h!*�u��h�h#�7ډ���ч΍R�0�Aa�8z�1?�wLQl�$�e�$�^wL2�m�$��T��17lZ�Q�������b����F�<�w4[���قOz{V,]����lH�ؑ�z�s��;-9� �T��L��'�B�����X�A���
Q�� �7�MWήl�r�ב.;�'g/�n�>�-��͐����
�Kb�Ւ�/��$���e����L;��y{vzIlP{$�_h�}b��Kb��Kb����+$Q8g�p3�h/��H�F$q5v��DQc�O/�&/�f����r��;(&�B�n�����6)�5��8L�NoԸy�W��$v�}��a1I��pXL��V��6�o�v[�: �78���A|Z�L<�C���q<�w.���ÿ�h��X'V�c�UK	����[ܱ��`tsf�	��dp����wJ8<�نa��`pf�A�ϰ�f0�3%�0�&ož� �5NbT!<q
/+K8	�P�X�����	'���zD?�����~1���׍׻%�x�p.x�v����8�&����X�8n�=G�a�9��)�BY0�tP���S���*!	/dO8!0�6�p����dI�,�����^���ܸЈc�1�	Ǆ�!wQ$K���ϰԶ�;8�4�p���_p,;<�b벨P��7��am�O���Ɏ���4��,* ��
�sT���;`���L��d��2�I�/ږIG�';7ܙ�� �\���p��S��M������F���L��lj<�!�k���Ȟk<d"�����s�]RE�6)�O�9���� gm\a7\�p��=�ܙp�8`8� ���J�F̌�s�T%&�y�jt���n	L8Q<�0Ӱ�j,��Gi�>:���	��ذP�k�����C��1�ǹ��E^����X\_%���\J�l�ź��7��}�O��ٮ�R��p�8Xp�|�	�`Q}v��~ �� ����������q���dK~�C��A.5�B�3Y��g��[$U	���w	�����z�[M�)qܸg\f����4�p�k��\�8�{����q?�P��3ʄo�C.VhD�R�(\���q���f�����˜4Q��	��Kv�z*��Q&.����e����j,���qg�\f�����9�
�2;�2�J^,��r�e��J�d��F1��,�Si��������ly�uc����4&\�����2���"o�a�~���21��>3n�+W)F{�H�(a� Uڌ�<�j! lA�[:��*a���Ha���H�Ջ�gw�����=���߭mxA�bp��N|ۑ�6W���ʾ��AOr�8>��q�l�&_,k)����{�jDd,�hq�b0��wa�8���a'Bp,r��S%�l���NK�Il.�V��L4U��X�{��Dt��$��N�r�R�8���a�h[��E�l4T)�d�oV�z'T�3���v��=؉���J�r���Fåʂ|�E?�Q�a�k4*|/�E��FX��$���5m���oP��D���m0�D���m,��]�g�/(60Dj�Y����#(u�E=,�Ө��c#~�5�H�8"<K�K�K�r�o��CF\������X�-��\j3�K���KkT(a�s`�E� ��#*14���+��8���"�ӯ ��}堉�=�%�#՞�;�ϟ����`�6      Q   �  x��[�rc�]k���d�t����)睉S�m6���ƣQIT\����5�$7�|/�~�n@5�+�W��������zw����?l�4�}�7��m�mK5m���dO���ͧ�^�-/Z��|Z�݆��K. �+i��V��R�9_��ӏh[B��(H�Jf߈q�"M����OĲ����rX�þ���}gY���K�
6�u���,!�̳����۟�w��f��O��������K�q/j�i�����,U�5�.�<�K�3hy�i��fTB�As��v�F]B���x�m��������/��SFh[	�/�mT�����
o�KY� ���V@�*h"�V@�6KZ�[��K^U���UP�Z�X�nM��Zm �aU�Y�&YrL��U&G�!��8���yx�qs�����͟���l$X����  �-����Ǹ�_�6��������7���<-�DI�<[Iऊ��� �k�E�e��	�QgG�,�3�x�*|��,ޡf��,ޡ	{k��$�]��g�*B���C��m��k��'�����C�jk��L�m���ָ�5֊}[+��l�sE��jq�E*Q%�f���/�O��v����~��x��nwؽ��mBmo�
i:��LP�#*8q#�����տ1�%�y#�Ƕ�P� �c[v(
rtl�#4@Ƕ��m#0��C��#�U���#�5x��#�D��3�8���ج.�\4����X��Y��Ē��k���ed�t<)W����7"�B�3�	?�
IuI*�`Vl���?�M��������?�RY�Tv��:�ᰇ-�X�\J�,��~xI/�{��`�A��?�.��7�[������H/�7�n6���=�$����
�T�4�tNJKD?�
�����-�drP��ϫ��;<­���������J7WV�b��g$��@uS}J�[��~���y~V�P4e�bx����P>��T(��^����9��և�O��7���il'��B#�L��Zq�u������K|$.V����<Xm��C�W��/��2�&�P�3�����}\r=5�/��ݗO�8��L�K�ӢAi�����~w��C��3�\{Z�h[�1RN[r
��ka�ro8��΄���X�8,�@0���[<���𚧂pd�t\�$J�go6����<�%����U'Gz�Y�G�|d4֨�V^y���o���7������3g����a���[ ��+l�D��-j�i�	h3�kA�7mIVX1�Nֻ�B���x|$!3��"uU�jo����N�F���(�	����Ӳi�I�#Zj�� ��ᬃ�j��v�׍䑗]o0jk��������������/�םs��`8'G
�Pbe-�NϞ9��d�px�G�Ȓ��<ӌ�ԑ�I@u���	�r�y��Fq���M�y��$=�y��\�L�!�y3���&�dh����,@���V�c�Q�!<3N��q��Z]jAE�pl�ף�N�q�؊��$C|%����Zw8r ��]�J���q�h0���wa>eElFCz-�LX�a��d���e-�۩RW@+Ǘ��9TQa�V@u�mUYae�����C�����3�Bw4�G��qw����d�bE�)i$ͦcG
�?+z)|MW#�vx^��(N��5[�$8WUf;� K�!7G8|R$?"��s����l:[��Q�WL�M�┄n��bUmjmf��<�����]� �C�h��{�d�I��
��^������5)EH��[^E�hp��!�*�Q+kCNZ G+��a��c�^B�j���L^��YWk�_�0��u���d��j��� �l��7kN�#q�N
���l�o - 3��m��F�&�+�mk%>����x}'��t!ؿ�}�ق���?%���#��?&������+�����c�����FJPj�$�*�jEm@�O�ǎ�~���E�_.���>���G��WRO�W�g;i~����~\e�N|4T����)R��8��G)���Xh�I�9����e5�����W��%�
�_/��S<>�	��~�c��G ��T#W���0�9��"X����N��Y����IڰS<B2Z���Q�?%qe�}����N�R�%�F�Ҷr'f�DM�&�B�?�{c��>���Oj�$�X��N"KwA��㪝�2jј�W�8xǣ@$�2���3Rd,���󝠙����;/�vb��k���za&rF�`S�!�o���WR廛��q'6�x�C�kE��Eي��$�Ր|e6�x�3xk��?�s�����1	���#�F��R=�٥��P���d���G��WVc%MZ�����Ha�9¸���9�UTr�|?�q��xt�z�Há���B/�I&;!�,�
G��뚝��C�W�Ь�ᡌ[R׭iԯ���3�]�������jl�����)I�B�x.K3���I���2|�4SQ�����W����(2/���W��^#ċ�f�'<.)����y���Q4�ԡ$N���Dͭd�J�u[i|}��y,��jjE�C�
���>@Fԋ��l/�5LP-<)�j/�*"�e�#k���.8`�|	��Ҽ	��eU��V���w!EWm%�Z��T�8�H�3ݘoA�_��A�N�O�43=����ꥬ2}�G*6s�\ʰ3p� ᡍ��P�3p2��<�iؓ����꺰����˗Vga�\Rf�6�y�ao�A^��;�:	�N�ȫ����k��Y��k۾��b�������Ƌ���CdW_�$�;�q�A�w��ܘm�b�DYcr����Ōa�N'�ܸ�v�B�.���J��q�)��Y<9ڸ�w</��c[Q�Ӗ�/XX.�^$��M:!-P��{���$~M�T&�6.���mE�O| �Dȼ@�j��w_�BS�1��&�;+A��Y��q�'>�M�4:*!~E�'�'`i�X��E�$�;�-h� qWm��yA7��X&�=��"'#A��WD}'QL>i��;"ɉ�a{/��I��)`���1a9M��%�n��yABQ����OYS��Lְ��x����?��IR�)j�Q|/6:�'|��
����鮓�^ڢ�o��`���a���;�O�J%%2�;�h�
�����݌|&�e���Ƽ�С�>t���Gy���u��D_�O?E���	�����suGR㋇����{�&��(����n��]M�$l��9�a��x4N5B0�t��I2���E�3N�Ox$���.JNt����	�N����3@N�����׫�c�	�}�ueͥ��Ɓ͏���=+�l�I��.�t�������-$���lXA�_\��]�đ����K�j��1�;�,�vLp��0�!a�l6�9���@��-�ب�;���6�x�������cUl㉍o=������O0H5��k�3�/;|���a�y�=<~�|������3�{�o>l~��/����5�o_~�_F��w5bi�&��������vw7ף��?^@���e�{�������WA�����*V| �~����O���������io><�E��ޔͼL�G��5)��4w3O���F��| �q�|*��>�3��ˮ���Xi�7=��%L�f|lN�0�=�������*�E9�5�-�4�|~����^���򹓔E�>�̢�xh���Ao�fQGVfX/�%O=+Rs��A�����a���w�������#>q��W�<kL;��f6�	���C�#) �������)�li?��y�W��՟�x��^�$οk�<�G<��RZV�rI��7!��Q�V������)�/�R.�?���
MJ������	���V�7��Rcr�/���5lL�$���/Q�\�w<�����Z��OH�p��̗K���m_��4x&)g�(	�`ՙ����.���-�޽�/����      S   �   x�=�M
�@�ur
O ����B
Rq�&РC�I�dPoo��,�Tpᨑf�Ė��F-.���>�RJo���0P�m98�@�=�ɓ#�P͒���L�aj�H�Gܗ�<���E�.ˆ5�>��fzH>ɋ�䌇b�.q*h��c�P�W�,��Ǎ�1G��T      U     x�%��u�0Ϧ�<@D/鿎�nN�/���}����-�c�Y�k���qm�7_�� �-x�#X�GH�]A �E	
�"���T��聆���'
Њ�f\t@!B��D�б<�byB�B5,L���h�P�����0>�;�O������	!O8R.�R�3J����j*j�����*pV�f��
:��[x��K�;x�D��"tU#���D�����(x[�FJ�;J���P������;Ph2��O�ʹ��;�h�p����_n      W   �   x�E�A�0�sߏѵCwO���e�E����]
�ۗ6�L��'YtS9�6	J:��%�!����]��w�u&�P;)��a~k�e�c.��#I��G�-]���Kj��JMǸ���0�:�d[S�������� �$@5�      Y   �  x�=�K��:���W8p�	ᕡh�� }�Q��$B��� ���/��S�*�����WV��/A�W7��ɓ���=Y�v�}'���o�D%ɽ)w$���v��;/�63���o���2��,a�x�u3Ȫb�`��|��'�|�)�x�kוDj�+H�z�����o��>�O�zt;�mϕx��
����<�Z�*�˰z����%��x�|�������g@5&*NT�R�;d���骜�r�M�ni�6]&,�ϑ Xӎ&\ Hdl(�,ho�7`<x�	s���Cq��y������9�D��x��l�{vY�ν�=��_� ,��p�`�(�
bZ����-�_돥�������^��*%�z��6��m�U,h�\����y{�_�2���e��k��������BsWXM�Z�[:�i��پO�?�魮<_Ep��.���AZ
�t`Ѡ�D?<���QѰ��$�ł1_^�Z��;dR��aEk���ҫsp6ת��h	����Cc񌏿�`�3F
�U���ߑ~�v/������������d(�i�ox�	<��C��S���/۵_g��>�x#xO��B� ]i/��_XKFW���U��kM������,i{�m$�~�NL?2GG�mb-�3�p�W�F�� i      Z   I   x����0��0L.�%ݥ��QlQ,O8}4��Ah�^�)J4�u��\�v-e����l"c#^���?��~      \     x�=�Mk�0��ү�l�b�I������lv��$������l7���+Ye5J�	��;�8Jh���L��>�..�!�1��a�fLUƱ���t�s<@}wQ�X�H������j2
h���Ʉٛ6�	2M��I����M�*��IB��Ȟ��J���3��X=�]hv�	)�	/�)���P�>��Cڍ���][��曑#�R����je�<T5�5��ya����M��g��]碝���z(A�f{RH��#�/aI`�      ^   9   x�3�LL����2��M�KLO-�2��N,�L,O��2�HƧ�$���p��qqq Ã�      `   �   x�M�M��@Eי_1���I�粂��J�.݄v��5�T迷�H����E(�{`��
��,��Qb��.G@7wf	{�S������~�������'�>��
�������l�Sa����x
)����K��@�3(%6C��?s|P
�!��C�g�A�gZ��qg��qk���dHwϺ>�ߢ�`	�N�T�$�Q����$IU�     