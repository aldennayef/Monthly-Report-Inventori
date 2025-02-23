PGDMP                         |         	   inventori    10.6    10.6 T    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �           1262    18040 	   inventori    DATABASE     �   CREATE DATABASE inventori WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE inventori;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    4                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1                        3079    18041    dblink 	   EXTENSION     :   CREATE EXTENSION IF NOT EXISTS dblink WITH SCHEMA public;
    DROP EXTENSION dblink;
                  false    4            �           0    0    EXTENSION dblink    COMMENT     _   COMMENT ON EXTENSION dblink IS 'connect to other PostgreSQL databases from within a database';
                       false    2            �            1259    18087    cluster    TABLE     �   CREATE TABLE public.cluster (
    id_cluster bigint NOT NULL,
    kode_cluster text,
    nama_cluster text,
    create_at timestamp without time zone
);
    DROP TABLE public.cluster;
       public         postgres    false    4            �            1259    18093    cluster_id_cluster_seq    SEQUENCE        CREATE SEQUENCE public.cluster_id_cluster_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.cluster_id_cluster_seq;
       public       postgres    false    198    4            �           0    0    cluster_id_cluster_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.cluster_id_cluster_seq OWNED BY public.cluster.id_cluster;
            public       postgres    false    199            �            1259    18095    items    TABLE     �   CREATE TABLE public.items (
    id_cluster bigint,
    kode_item text,
    jenis text,
    nama text,
    note text,
    create_at timestamp without time zone,
    nik text
);
    DROP TABLE public.items;
       public         postgres    false    4            �            1259    18101 
   jenis_item    TABLE     �   CREATE TABLE public.jenis_item (
    id_jenis bigint NOT NULL,
    nama_jenis text,
    create_at timestamp without time zone,
    id_cluster bigint
);
    DROP TABLE public.jenis_item;
       public         postgres    false    4            �            1259    18107    jenis_item_id_jenis_seq    SEQUENCE     �   CREATE SEQUENCE public.jenis_item_id_jenis_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.jenis_item_id_jenis_seq;
       public       postgres    false    4    201            �           0    0    jenis_item_id_jenis_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.jenis_item_id_jenis_seq OWNED BY public.jenis_item.id_jenis;
            public       postgres    false    202            �            1259    18109 	   kunjungan    TABLE     �   CREATE TABLE public.kunjungan (
    id_visit bigint NOT NULL,
    kode_visit text,
    jenis_visit text,
    nik_visit text,
    nama_visit text,
    tujuan_visit text,
    visit_at timestamp without time zone,
    id_cluster bigint
);
    DROP TABLE public.kunjungan;
       public         postgres    false    4            �            1259    18115    kunjungan_id_visit_seq    SEQUENCE        CREATE SEQUENCE public.kunjungan_id_visit_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.kunjungan_id_visit_seq;
       public       postgres    false    4    203            �           0    0    kunjungan_id_visit_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.kunjungan_id_visit_seq OWNED BY public.kunjungan.id_visit;
            public       postgres    false    204            �            1259    18117    log_data    TABLE     �   CREATE TABLE public.log_data (
    id_log bigint NOT NULL,
    id_item bigint,
    id_user bigint,
    username text,
    act_note text,
    act_date timestamp without time zone
);
    DROP TABLE public.log_data;
       public         postgres    false    4            �            1259    18123    log_data_id_log_seq1    SEQUENCE     }   CREATE SEQUENCE public.log_data_id_log_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.log_data_id_log_seq1;
       public       postgres    false    4    205            �           0    0    log_data_id_log_seq1    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.log_data_id_log_seq1 OWNED BY public.log_data.id_log;
            public       postgres    false    206            �            1259    18125    opname    TABLE       CREATE TABLE public.opname (
    id bigint NOT NULL,
    kode_item text,
    nama_item text,
    sisa double precision,
    stok_real double precision,
    selisih double precision,
    hasil text,
    waktu timestamp without time zone,
    id_cluster bigint
);
    DROP TABLE public.opname;
       public         postgres    false    4            �            1259    18131    opname_id_seq    SEQUENCE     v   CREATE SEQUENCE public.opname_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.opname_id_seq;
       public       postgres    false    4    207            �           0    0    opname_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.opname_id_seq OWNED BY public.opname.id;
            public       postgres    false    208            �            1259    18133 	   pemakaian    TABLE     .  CREATE TABLE public.pemakaian (
    id_pakai bigint NOT NULL,
    jenis_pakai text,
    id_stock bigint,
    jml_pakai double precision,
    nik_pemakai text,
    nama_pemakai text,
    nopakai text,
    pemberi text,
    deskripsi text,
    waktu timestamp without time zone,
    id_cluster bigint
);
    DROP TABLE public.pemakaian;
       public         postgres    false    4            �            1259    18139    pemakaian_id_pakai_seq    SEQUENCE        CREATE SEQUENCE public.pemakaian_id_pakai_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.pemakaian_id_pakai_seq;
       public       postgres    false    209    4            �           0    0    pemakaian_id_pakai_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.pemakaian_id_pakai_seq OWNED BY public.pemakaian.id_pakai;
            public       postgres    false    210            �            1259    18141 	   pembelian    TABLE        CREATE TABLE public.pembelian (
    id_beli bigint NOT NULL,
    kode_beli text,
    no_po text,
    kode_item text,
    quantity double precision,
    satuan text,
    status text,
    realisasi_at timestamp(6) without time zone,
    id_cluster bigint
);
    DROP TABLE public.pembelian;
       public         postgres    false    4            �            1259    18147    pembelian_id_beli_seq    SEQUENCE     ~   CREATE SEQUENCE public.pembelian_id_beli_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.pembelian_id_beli_seq;
       public       postgres    false    4    211            �           0    0    pembelian_id_beli_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.pembelian_id_beli_seq OWNED BY public.pembelian.id_beli;
            public       postgres    false    212            �            1259    18149    staging_stok    TABLE     �   CREATE TABLE public.staging_stok (
    kode_beli text,
    stok_staging double precision,
    kode_item text,
    harga_satuan double precision,
    exp_date timestamp without time zone,
    id_cluster bigint
);
     DROP TABLE public.staging_stok;
       public         postgres    false    4            �            1259    18155    stok    TABLE     �   CREATE TABLE public.stok (
    id_stock bigint NOT NULL,
    kode_item text,
    quantity_real double precision,
    exp_date timestamp without time zone,
    harga_satuan double precision,
    id_cluster bigint
);
    DROP TABLE public.stok;
       public         postgres    false    4            �            1259    18161    stok_adjust    TABLE       CREATE TABLE public.stok_adjust (
    id bigint NOT NULL,
    kode_item text,
    sisa_stok double precision,
    stok_real double precision,
    stok_adjust double precision,
    adjust_at timestamp without time zone,
    id_cluster bigint,
    deskripsi text
);
    DROP TABLE public.stok_adjust;
       public         postgres    false    4            �            1259    18167    stok_adjust_id_seq    SEQUENCE     {   CREATE SEQUENCE public.stok_adjust_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.stok_adjust_id_seq;
       public       postgres    false    4    215            �           0    0    stok_adjust_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.stok_adjust_id_seq OWNED BY public.stok_adjust.id;
            public       postgres    false    216            �            1259    18169    stok_id_stock_seq    SEQUENCE     z   CREATE SEQUENCE public.stok_id_stock_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.stok_id_stock_seq;
       public       postgres    false    4    214            �           0    0    stok_id_stock_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.stok_id_stock_seq OWNED BY public.stok.id_stock;
            public       postgres    false    217            �            1259    18171    user    TABLE     \   CREATE TABLE public."user" (
    id bigint NOT NULL,
    nik text,
    id_cluster bigint
);
    DROP TABLE public."user";
       public         postgres    false    4            �            1259    18177    user_id_seq    SEQUENCE     t   CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public       postgres    false    4    218            �           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
            public       postgres    false    219            �
           2604    18179    cluster id_cluster    DEFAULT     x   ALTER TABLE ONLY public.cluster ALTER COLUMN id_cluster SET DEFAULT nextval('public.cluster_id_cluster_seq'::regclass);
 A   ALTER TABLE public.cluster ALTER COLUMN id_cluster DROP DEFAULT;
       public       postgres    false    199    198            �
           2604    18180    jenis_item id_jenis    DEFAULT     z   ALTER TABLE ONLY public.jenis_item ALTER COLUMN id_jenis SET DEFAULT nextval('public.jenis_item_id_jenis_seq'::regclass);
 B   ALTER TABLE public.jenis_item ALTER COLUMN id_jenis DROP DEFAULT;
       public       postgres    false    202    201            �
           2604    18181    kunjungan id_visit    DEFAULT     x   ALTER TABLE ONLY public.kunjungan ALTER COLUMN id_visit SET DEFAULT nextval('public.kunjungan_id_visit_seq'::regclass);
 A   ALTER TABLE public.kunjungan ALTER COLUMN id_visit DROP DEFAULT;
       public       postgres    false    204    203            �
           2604    18182    log_data id_log    DEFAULT     s   ALTER TABLE ONLY public.log_data ALTER COLUMN id_log SET DEFAULT nextval('public.log_data_id_log_seq1'::regclass);
 >   ALTER TABLE public.log_data ALTER COLUMN id_log DROP DEFAULT;
       public       postgres    false    206    205            �
           2604    18183 	   opname id    DEFAULT     f   ALTER TABLE ONLY public.opname ALTER COLUMN id SET DEFAULT nextval('public.opname_id_seq'::regclass);
 8   ALTER TABLE public.opname ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    208    207            �
           2604    18184    pemakaian id_pakai    DEFAULT     x   ALTER TABLE ONLY public.pemakaian ALTER COLUMN id_pakai SET DEFAULT nextval('public.pemakaian_id_pakai_seq'::regclass);
 A   ALTER TABLE public.pemakaian ALTER COLUMN id_pakai DROP DEFAULT;
       public       postgres    false    210    209            �
           2604    18185    pembelian id_beli    DEFAULT     v   ALTER TABLE ONLY public.pembelian ALTER COLUMN id_beli SET DEFAULT nextval('public.pembelian_id_beli_seq'::regclass);
 @   ALTER TABLE public.pembelian ALTER COLUMN id_beli DROP DEFAULT;
       public       postgres    false    212    211            �
           2604    18186    stok id_stock    DEFAULT     n   ALTER TABLE ONLY public.stok ALTER COLUMN id_stock SET DEFAULT nextval('public.stok_id_stock_seq'::regclass);
 <   ALTER TABLE public.stok ALTER COLUMN id_stock DROP DEFAULT;
       public       postgres    false    217    214            �
           2604    18187    stok_adjust id    DEFAULT     p   ALTER TABLE ONLY public.stok_adjust ALTER COLUMN id SET DEFAULT nextval('public.stok_adjust_id_seq'::regclass);
 =   ALTER TABLE public.stok_adjust ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    216    215            �
           2604    18188    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    219    218            ~          0    18087    cluster 
   TABLE DATA               T   COPY public.cluster (id_cluster, kode_cluster, nama_cluster, create_at) FROM stdin;
    public       postgres    false    198   !Z       �          0    18095    items 
   TABLE DATA               Y   COPY public.items (id_cluster, kode_item, jenis, nama, note, create_at, nik) FROM stdin;
    public       postgres    false    200   zZ       �          0    18101 
   jenis_item 
   TABLE DATA               Q   COPY public.jenis_item (id_jenis, nama_jenis, create_at, id_cluster) FROM stdin;
    public       postgres    false    201   Fc       �          0    18109 	   kunjungan 
   TABLE DATA               �   COPY public.kunjungan (id_visit, kode_visit, jenis_visit, nik_visit, nama_visit, tujuan_visit, visit_at, id_cluster) FROM stdin;
    public       postgres    false    203   ?g       �          0    18117    log_data 
   TABLE DATA               Z   COPY public.log_data (id_log, id_item, id_user, username, act_note, act_date) FROM stdin;
    public       postgres    false    205   �l       �          0    18125    opname 
   TABLE DATA               n   COPY public.opname (id, kode_item, nama_item, sisa, stok_real, selisih, hasil, waktu, id_cluster) FROM stdin;
    public       postgres    false    207   Z�       �          0    18133 	   pemakaian 
   TABLE DATA               �   COPY public.pemakaian (id_pakai, jenis_pakai, id_stock, jml_pakai, nik_pemakai, nama_pemakai, nopakai, pemberi, deskripsi, waktu, id_cluster) FROM stdin;
    public       postgres    false    209   #�       �          0    18141 	   pembelian 
   TABLE DATA               }   COPY public.pembelian (id_beli, kode_beli, no_po, kode_item, quantity, satuan, status, realisasi_at, id_cluster) FROM stdin;
    public       postgres    false    211   �       �          0    18149    staging_stok 
   TABLE DATA               n   COPY public.staging_stok (kode_beli, stok_staging, kode_item, harga_satuan, exp_date, id_cluster) FROM stdin;
    public       postgres    false    213   #�       �          0    18155    stok 
   TABLE DATA               f   COPY public.stok (id_stock, kode_item, quantity_real, exp_date, harga_satuan, id_cluster) FROM stdin;
    public       postgres    false    214   ^�       �          0    18161    stok_adjust 
   TABLE DATA               y   COPY public.stok_adjust (id, kode_item, sisa_stok, stok_real, stok_adjust, adjust_at, id_cluster, deskripsi) FROM stdin;
    public       postgres    false    215   ��       �          0    18171    user 
   TABLE DATA               5   COPY public."user" (id, nik, id_cluster) FROM stdin;
    public       postgres    false    218   �       �           0    0    cluster_id_cluster_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.cluster_id_cluster_seq', 26, true);
            public       postgres    false    199            �           0    0    jenis_item_id_jenis_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.jenis_item_id_jenis_seq', 111, true);
            public       postgres    false    202            �           0    0    kunjungan_id_visit_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.kunjungan_id_visit_seq', 191, true);
            public       postgres    false    204            �           0    0    log_data_id_log_seq1    SEQUENCE SET     E   SELECT pg_catalog.setval('public.log_data_id_log_seq1', 1238, true);
            public       postgres    false    206            �           0    0    opname_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.opname_id_seq', 30, true);
            public       postgres    false    208            �           0    0    pemakaian_id_pakai_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.pemakaian_id_pakai_seq', 211, true);
            public       postgres    false    210            �           0    0    pembelian_id_beli_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.pembelian_id_beli_seq', 322, true);
            public       postgres    false    212            �           0    0    stok_adjust_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.stok_adjust_id_seq', 12, true);
            public       postgres    false    216            �           0    0    stok_id_stock_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.stok_id_stock_seq', 120, true);
            public       postgres    false    217            �           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 10, true);
            public       postgres    false    219            �
           2606    18190    cluster cluster_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.cluster
    ADD CONSTRAINT cluster_pkey PRIMARY KEY (id_cluster);
 >   ALTER TABLE ONLY public.cluster DROP CONSTRAINT cluster_pkey;
       public         postgres    false    198            �
           2606    18192    jenis_item jenis_item_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.jenis_item
    ADD CONSTRAINT jenis_item_pkey PRIMARY KEY (id_jenis);
 D   ALTER TABLE ONLY public.jenis_item DROP CONSTRAINT jenis_item_pkey;
       public         postgres    false    201            �
           2606    18194    kunjungan kunjungan_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.kunjungan
    ADD CONSTRAINT kunjungan_pkey PRIMARY KEY (id_visit);
 B   ALTER TABLE ONLY public.kunjungan DROP CONSTRAINT kunjungan_pkey;
       public         postgres    false    203            �
           2606    18196    log_data log_data_pkey1 
   CONSTRAINT     Y   ALTER TABLE ONLY public.log_data
    ADD CONSTRAINT log_data_pkey1 PRIMARY KEY (id_log);
 A   ALTER TABLE ONLY public.log_data DROP CONSTRAINT log_data_pkey1;
       public         postgres    false    205            �
           2606    18198    opname opname_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.opname
    ADD CONSTRAINT opname_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.opname DROP CONSTRAINT opname_pkey;
       public         postgres    false    207            �
           2606    18200    pemakaian pemakaian_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.pemakaian
    ADD CONSTRAINT pemakaian_pkey PRIMARY KEY (id_pakai);
 B   ALTER TABLE ONLY public.pemakaian DROP CONSTRAINT pemakaian_pkey;
       public         postgres    false    209            �
           2606    18202    pembelian pembelian_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.pembelian
    ADD CONSTRAINT pembelian_pkey PRIMARY KEY (id_beli);
 B   ALTER TABLE ONLY public.pembelian DROP CONSTRAINT pembelian_pkey;
       public         postgres    false    211                       2606    18204    stok_adjust stok_adjust_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.stok_adjust
    ADD CONSTRAINT stok_adjust_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.stok_adjust DROP CONSTRAINT stok_adjust_pkey;
       public         postgres    false    215                        2606    18206    stok stok_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.stok
    ADD CONSTRAINT stok_pkey PRIMARY KEY (id_stock);
 8   ALTER TABLE ONLY public.stok DROP CONSTRAINT stok_pkey;
       public         postgres    false    214                       2606    18208    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public         postgres    false    218            ~   I   x�32�p���������lW���HN##]]#K+0�22�twk �pŞp���1z\\\ 9l      �   �  x����βH���*�z�>�YUP6�L�ad�U�����y�N&�tubܒ��Sg)���M7��Hع8��T5���/�@4�~�+!�J��?�n�Q<��$�ȥ����Hg���3����,㱚�`�eZ��~ѻ�o��g`��Ǹ���G,��Z�!�5�U7���/.����x��B�$�M"L���$�&)L��&iL��&L��&YL��&9L��&yL��&L�O1D`扟ADb��E;L�g����(�0I.	����F	�K����}�<���ɱխ�|�`L����S��_7�8�<]�m`y�����y��J�=��WŁk����Cuw��s�ƴ�0�*�D�5�b_�
�t7��v���z�L� �>Vu�P�O(}�I���Mr��00��ƈz�<����:u��{^���P$�+=�Q�`��7D��Q^�`�=
�Hͷ4��-��|��Z�Ȳ��TQ0;We�J��^�չ�
����u�T�pNՓ�z֝��/�G���~%PΈ�b@���
�Q��18���	��P�lU�ea����r>n}|a�8xN�y6�c��a�T��ׂ�S��S6�:2��o���˓n͖Y�~�1U�&�߆A{� �k��䉂r�m����z87�, re6�X�Kw(�/�U�$�S4�n�@1�r�v��6��!�h�>�M��-�Jn�j��_�>M1[	��F��A�%ձz��$+��Ō+����"����o�$Ͷ�sa�S��>w\����Ϫ4�)�ov��k��H�,�ax��4���d��R��~�� �Tq���2�� .\o?�(fo�S��T�F��q~i!aS�����k��*V�:��Ҹ�pS��v��#��v���Lq�m
.�q�ݼrNg����!�;���la���N�L�-]��,�םB��n�'�G�8���U�����
��!֛�¥@��>lLE_��c�>ߢ�N1g^x��~�Ҙ�DS� ���3U��a>'�Y��oF>��"W�@���>���nC`�(Á�S;��������EB0�����c2�H6rOUOP{ɸJfIe(�,��0�w����W7y`N�譸i�53�b�g�@��Hjq{�)�/�Y�Lo~K���	�&��*�dER��6���KY��ErtL�KĐɘ��Z=w~e�|41U4x���w�X:��!�r��z�$� ��������we+w^�}vZ�	�Ӿxu�lv�:�oR_$����cˁ�k��Ӯ�'���8�g�ꖤ�q㊇�R��E����f�GiNՋ���+��ܳՁ�;s�s,��nO�!��
�%P��,�B���w�僃�ۘ*�����i��Z"%TO;/���B0��0��q���S�u�/!�O̊�}r�/*�R�	�e��k��pU4̙���CH$o3�׺�[Ba��w�1����~&����0����gJ��ԯ�Fp!_d��;?�#ma΃�Ե���2LTߢ�͑��ጩ�����6�� �ޙ�,2*|c� � �ݑ����/�h�_�72��	X���g��>��_��$�v���7���'�����*[H�rϺ��2���9���B@Ѩvn�=�+i9ω ��]
�ٷ�쯚��E( ��~}��nhU`�>���\w7�ͧ��;GeΌ�<��p1U��lE��@{)g���l����Y����R�`-�>�=���e�U}�3͌
M���X��؞��|�S�Ck�kl��{g���JI]�����(/��
�4�*m�{)!�\�L�f	�� Z����Z��Ҝe�@�O��,�	��|*]�N���Rt��������F�y���RI�vݘ��z�L��E"�m��iX�4��%�T`�+��K�Ӥ2x[��	��ղK�4�1���"�"�̢�BmL�֐Ykq��ޘ�O'�=���UD��xX+�I�^�s�8p�eȐ����ˬ i-�'��ʵ��V1�Z�����v�n��O��gE/��C[��6/�(!3�x���w�r������d�jm�spp]$������]|�זJ�-��E�y<@~r����M�]c�xY�z�.�iȫ��%	�cbu���@�$N:v�-��Iаo�Tr�-� ���Uh(u�6�ǽ�B0�g���Ժ����a��64�Kۇ��.����K�C���9oI8�h���B���Ѡ?k���PhЗ�����Ǐ�l\�      �   �  x�}��βH�u}W17�O��n����<�
��� 'QQ< �Տ��rj>��/UM����_����?��?? ��p�G���CP��*mP!`�'����&�$����q��zcHS��Շ���Q�B����_�)���E�FN_:(��tMmןU1^�6����U��=�Hs�f��.7(�`h�C��Q��H�g��z��|	Xf�"|m���"	f!�lna�*Pe��g�s��~��қ
Gޓ�L���j{�=���~���fN���<�;1��u��F�P�t��*b4�T�H�[F^>_*�9������H¸0Fz9~�Gb
�`��e[�p)c��V��Ɨ�ߎvi�Bߎi�l�pQM��(��󌞮ѳc��E+�cޡ)`���e��"�a���S��5	�k���l@w�I`��2����1�P
�ڹq@���	m$����� ��J~��ET4���F&h�����OG�����Xe^=?�Qā>��L�Q�F����1��E6�yt���$�^ݵ�O������E*�S���L�+[e��#D�E�`M��&��M�N![���T��EnA���{���Ó����~��o�۴�U��(�̍@��H���%�6��w7ѡ(���0���e�"�'�uAsD�I���rF��)��=�XQ�ʴ�>9��-D��7�Z��4J��-�utP�[g�N>e,Q����ێ./�0���jc��	���6y둙�p�����q�=I�Y�t�7������=�Q��PDAi�OP��-�q�`6�,e�����o�z�?�)%u��*ao��W���+U�vӣ�@J����XO�@�I�>6�[���و����PtmN��B繪�ա�)������x/�5��>�}�\�E��SU|�]Y�u��kU�`u�[+��<ŕ���-���7om?�����%�������*U�6���������?~~�l���      �   p  x����N�F F��S�vW���3掭�vEUQU���^�"��&�J�*��u�x�%_�B r��9��v���W��]ux3��~{��ݏŷ.+�����~�)�����Z�7Ӈ�u?��~�)��r�����~;�������Vֽ���U(+^��*l{VW��j|���v(/6���?�[����R�š��M�-����^rT�qL3s,9.�L���M=���π;g�̔��fA��/���/�Y���w���Z�8r��Y����HWw�ci���c�����^�{SϘ��p�s�i�'�[P(�^���O�����O��	��j!�).��/繣a̲	��y5���tDC?��)�8�0���<r�lu��ZKi�8F��:�Q�����v�0�=�0��(l�	������X��)��V���~kNDi���(tߪݏ�o��G
ݷj�#��[���K���[���B����H��V�~���Z�~���Z��Li�~�v?R�~�v~u���Z�~���Z�~���Z�~���Z�~���Z�~���Z�~��}�v?R输�����龓�O
�wR�I��N�>)t�I�'��;����}'u����O��"���N�>)t���O
�o��ϔ@����B����B����B���f���~#v?Q�~#v?Q�~#v?Q�~#v�����o��'
�o��GJG�[���B�[���B�[���B�[���B�[���uˎ�j�#��j�#��j�#��{���B�����b*����'��j���{��m����?a �@° ^]��a�:	�xu��$+���,�
u��
$+�HV �+�0�@PW aX���@°A]�1�@PW aX�N]��a:u"Ʋ��	�
t�
$+Щ+�0�@��@1�@��@°��	�
t�
$+Щ+�0�����01�
D�f� b1�
�*b,1�
 S#� 0�q�i�W ��q��Ĉ+ +� �1�
,�:�F; �0��v�aX�0ð�`�a�#��
hW��F+��fV@��0��v�aX��N�v
�aX�0ð�1`�a�k�	SG+��fV@��0��v�aX�"0ð�I`�a��@b8
4�Q��q�
hW����3+��fV@;�0��v�aX�40ð�m���w�84�q`�a�����<Ш����} 0��z +�^�
�'���ꍠ�7�84� 0��z%+��	�
�w�	á�Q�a�KA`X�T�ƛ^�
�VV@=�P��a�sA`X�^V@=�P/m���i2x��oo��O7W��#�_?����Կ"?<�<|�~ƫ�;�f�%oY����}�3o��������__=�      �      x��}Yo���s�W��އ.H�l�>$�3:�Ǚ�<ǳ�)ï�\,w'�Tui��4pN��v��H�\�*������e�_�����>������f�l�������[��?�>:]�?�.����>{���/����]���!��)��`Ң�E���}��(�<
{x�}ut���Fv�&v�Z��h������ӣ���_=y�}mga����-��Ec�8�'ۿ�����Py1�.kba(;�BF�36f��ߠ��o�..Ϸ���0w�V��SsU�
��"ù������_p4g�"��$�.0�}����T�~ѕ�G
�1�1u~*,Z�E���*��z�t����1v�wOn/��ig��Ő��\��yG�Dۮ�d&z��OnOnN�//�t��e��lH~у�����}s Gњ!H[��,��K��,:&�����f�����8o2ϡ�	f�P�����My*q7�d2xA?ʲ���g�y�^�r�3���vc㔹r<]�v`U� �y���@U���/��2[c�
6P_�t֒5/Z�5О�h�W�}�쮙�`�a�
�g�ƣA����y���*V0�4��^��b
�xQ�A��=��%��F�"�e���F�����Z��h�Y�е���h�BЊ���-d��w������_���s4@i��H9���5�c�3��[;�"��ƣ�c�aI�A���P	gi����۔˞�)W�*8N���;W��u�ݠ��5�Ğl�p��w�
L�����w!1Ns�gq8ڏ]"�}=گ�$�Áo�p��Tp��	ԑ1��:�R���IQ�_tjِ�
�&u�r�����95 ;�%�!��fB[��F��s�53�*Jg�Y��o��U�΋>t�ڄ���&���8<�\���q�bS:k)!��}qd�e����we���&�������Y��F׫G�_��Ёf�z�*��|�����Ջ����'��M��Bv<Q�a������)ϖ���͓�
r�Ȗ�SF	O��?,�z�q��\�9�Q�!{���H��t��՝}�a;�����s9`�GB��������gߖ6/>k�RE�
�/��t�������7뇺��F�E�^'��1W{/�.^>1����Φ����#�~G�c���l��n�3{{�[y6dˬ�#�^y���(���ۓo4�l, ȈU�~��f՜~x�����+��mȼ�q�o�p�>n�ݾ{��2���YGl�j��������������b�($2�>{y�������[:���$NXy�o�����/����/_�^h�22��8b�+�?w��^�Y�zR��說�� -".�#6h��7pgߜ�:�����Wl�-bÎ#6������<���M/�?�g�dd^�4b�?�����w�wO/vwu��+6�A/��4b��<�8x�ev�_^��|�D8��#6��<���������m|��+6�8hc�t��������ے�P�����&��#6x�=,�}z����Ʒ㏻�b���~#���ﶖo�h;~y���F�ؠ[�X�܉����ϋ���tY#Wl����#6�������Ŗ}���cE�� �$X�|cW��7_�}H��kϴUD�9��`��i�����g��t�*6�9}�n�^��WϞ�m]�]��*6ș��<b�&�.:]{��盽�e[#Wl���o�ܺ���}��u}w;o=y��+6�Y�.����˛���+�d������b��y�_�o'W�6���N���P�A/�<b�KW���Ҷ?�1a���H�b���F��B�^]������7Ʉ�22��<b��������.�o�x��U#Wl�3#�ؠr�~o��7���*q]�� #�u#6��u�s����f�KY� Wl�Sl�7ʈ�}������7K�/4r���F���?~���j{euM#Wl0,Z�e�oϋ;Z����~����X���H�7ʈ^l}�G�nn/�ύ�3]�dd^�2b�_�.��y�~E�t13Vl0��f�|���������������s��`�L��ؠY���xu�f�ٛ�gYWc�âg�1&쟄/�_nl�������F��`�Z���ӳ��Ĝ可�^�Uȩb�A2͚�� k;=������ۭ���i�Fd��&�?������뛯?���ׯ�ޝ*6�i����;��������ӝ�'�W�+6�i&3b�;K[��ҏ����ˎ��H��4�������;������O{g�b��y��oW�y���oV����o��Fd���*�`�]��/���>�����\���L3����so��c���>�ԙf��`D��̈^�rFWo�\�8]�~#Ul0"�Lc���}����������71�Fd�i���������Y������ʺF��`B���z���������x����`��`B��j]��Ok/>�<<||yJ�@#Wl0!�L����՞�χ���k�|�N#Wl0!�L��ї��M믏����ޡ�F�� �F����Ӌ��__�כ���V��b�	�f�u0<`]XO^~�~r�����F��`B��j�#/o>މ�GOw߽�B�:O�L�4S����>x�D+�W����N� Wl�����|�����Ks�}륎�J��b`�1������雃���ke����r���!~<�[o7?�xy�zr|�w�R�A�<b�k��_?�_��,��>���Tlj2#���V*��n������jn��`F����$�_^��v�l=�n�O�\���H��c?����7�6��[?��Ul�#��`y}����ށ�Y�;���2J��1��=��_y����������fd�i����hc����ۓ�;voKG�b���y�7������>��_o>~�Xi�a����z,�m�>=޺���cNuY͚�f�i���ɛ;�{��<y}�t�s k*fX�l&7b���凝����j�m�E�T� �Lc�/߿xrWNݳ��o��nc*�X$�kӸ������ۻ��{�I��5K,��:6��0��$��#2��Ngq�o�J��]ۅ�4�Az�s��W��
P�\�	Y{��-��.x~56��v2�L��ՈÁ�~���s�c�Uko� �@�_-���ޱAN�Eg
ެ�c��N0X�m)x�f^�,�C�h�!LQ{�,�Ȇ�r�w����%6Q�/��Ѵwl�,�ȇ.�`!���4K�`ٝ���"{U�Ll7K�~����ؽC3��,���#���Ll7K� ��ބ�����1 4Klr�s���=��-��x�a��u )f3�Z1;x��c H1�0�)�7ko�S�&�K'�3溙�N��S�)F�j-@�؄�.�d˦V����S�&t�g<^��p1 ���8�\�X�Z{� ��t2fǮ����M1 �x-�w 3��N�(Z3Z�,��)1��X�� ��a�1b H�����co���1��X�ѩ��k]@��~�>���S��a H��/��2� ���A��/z�b2����0 )V3N�Jlg��� Ek�;vBe�Z�� ��uX4�+����C�a H�ZZG���D����r��sb��u )b�E
�+�'�Z3��bv��9�h�l��` H1;,z�E���������D6��ި�)0���{5S<xTk R̎X�TBB�V� R̎8�3䰃�d� �l����5� GR6ل豦� )bCY�(�'j&vTĎ����k�� ��5�ɲ��5�:*^'�iěZĚ5�:*^'�i��C�WS���9Kg�a����@��}��7c��i�@��8��������> �x�8��u��j�� ��5�Į�����5�| H�:K
Z�EN\����32G�	� 5;)b��Ӆ�j+5�{ H[z�C�Q&���Ii!wd�fbgElT�����Gy��zH�;NB�+���ϰ(b�Z�d�$j&vV�.8�Yb�h-���E삺���L쬈]�ʚ}5;+b�E��
��fbgE�T�Qbq�L���ؼ�8-��h�j&v.Ț���j�u1�sk�}�    4�T� [�4��a�f^�@�h��X�F�k@Nqr��q�2P3��� �S��9j&v	�@v��_3A䚀; 5��]���@�%D8�F�����]�-r>�B�X�fbEl��ϰ�r(�k��Й:Em����;���:���MH�,G5��TW���	�dF��嚘:���MR>p��-#�q�PћP@p�6��X:���M� 8β8�5qtI�����goRC���	,(�����9��(�jô�)�C0��N�N�`r5as謧"��,ǡ��\�1���=$(Ñ���d�!$Ep/)I���t�T�!$Ep/ڑ7���CH��II0�.9�C����^���gG0�
i�р�E�k��sȐV<H����e�C����A¥B.b��9n��^��e�#hW"-)�GL�yaA�iIq<�!t�?S�iIq<��KFX�.FZR��P)P;�IQ<�J�"��4�S��#��V8ˡ�<'���b���8cf��q���⦔��a��)N��	�GL&c��)N�⸴�+�7(�S;ŝ�x�]3��@횤u��h�T)�N���u��I�_�����)�'̋wJs�,i��xF��،3�]��NQ<�%�@�va�:E� �n������,�W�f�Gjg�S��6��O�vm�:�px�O5��vq�z�p4[u!�3����+�g�I�{ �S�+�˵�1y�����^Q��.ƒ�յK��+�KKQF+�a�"����R�1�
�UJ�ť��om<��v��z���\�.�g��7�(��X���ەJ�g9�k>d8��.U�0�q+c�+�6�28�J���R�!+�j�R����$-J���	f	�H�i�Zx��Jf	n�J�� ��v�҆Y�[)yS��v�҆Y�[�T�0����Qod'�2a�`i�"�t<1��9�+�6*�K��܌�S�di����Lpd�횥���]&&��<���6*�[ЦD��������a/��e�v��F�q���h��څKǩ��d��ҥ���R,
%Xp�]��Qq\�E���.�]��Qq���=R;Ǔ�x_v*�b�k�/mR'�1S�i�gj�/mR�u&������Iq����P�����8�KE8?`>1�5L��]o�GLn1mR��]�HAf|��n�q���mA�]ƴIq�!\�����6)�ˍ~��XX�og�q����E�QڕL���X\�Ybi�2mV��t�8Te�v�g�q� ��ȑ#�s<+��b��P1�UJ��i�⸗X�~AFj�xV��='c��v�gEq�P%��['#�qxAQ< �(1Z�gj���4��Ц�H�W�&#�fl��]ԴJ�R�"������J�d$��fFj���5m�eRpx�v�+]@��cᴼ��V	��d�C�y�څM��M q����H�W�&#!*(	�i�6��6����]��『�x1ʚD �'t�qغ�}��������MFB�g�!31��MR�&#A�2�jd��C:JܴҴ�8�⌳�����M|X�t�rI����(q�JߖO)�S��IJܴҸ�����O�(q��u�)9�������MF���US�����7�8R)����9��M+���%�Үo��7��2��1O��IJߔs�]�p��]�$�oZ)e���r�W򦜴��<fNK��IJޔ�DyBx�v�+yS�tS?��]�$%o��Ɏ.fN8K��IJ޴Ru� ���J޴R�D���S;ŕ�	��	��9NZ*y��ztݻ��4�QKE��8RaW0�YK%o�}u5&��s��T�&��U����9�[*}���7�O�Nq%oR��p�	��M��j1{�(s�T�&Iu5��@��V�&Iq5��?�k���M��*;%���vq���IR\��"�k7I��d�����@��,�ⷅL����vq����H���2�\��IJ�$��rj�g�k���M��h���x��IJ�$���@%��.n�7I*��y�v�+m�� 
�k�6Ii����^4��Ԯm��6�U�J搾]�$�m�D��%����&)m�� �iZL<O��&)m�� ��/C1R;ŕ�I�їx?qL�vm���IR�>��]�$�m�D9i��s��&)m�����LS;ŕ�I�gK���\��IJ�R�8�+�Z��MR�&#y�q�����MR�&���%{���&)u9a���ٵ����M�r#H𸤢�����M�.�`�C6֮n�R7I�(C6$��Nq�n�TV-'���9�i�HP��t��5 e6|+P�(��h�mP8��;��yZ��f(ޓl�?��ǟ��T�"�]�X���PlhγG�Y�3��8����#��3���Bp��v@�l���;�	�f$Vq���|(BJ��(�j
�q�a�'�ʀ����9)����P�p2R�U��-��Cd�F��:6��$O5��R�9'lu�f3'��D�f3��|q�JP6ۡ�Y#�ce@�l����-�0���f������F(9�ɴ2�?�f�/W�8�w����ItG]e���X��^d�2���8��r�[�k��K�\B`�X�8_��p��f�?'��C�l?w�0ԟ���*�٪��Y/Xr�>2�?��`q�lNX�g3o=19��?��`����Ѡ�XN�_#4�������H'ǤN81ׇ����9;��\N{��~(s�|M��4��!��$�[$���߁5��V����I��؄����8��6cؐ�XSxo�(�@F�����7`E��8���c����=�]ةw9�h#�\�e9���Sh�X�P��8���K���d�<�ڣ3������a�7ٙ�MH��X�+�&`B�h3����ȣ�X�`K�O�[������%�'�'b�.��1X���=��W���$�Dr�ƂHn@)m��L� �8�����^�=>�&�^��"ܙ�u�K۱J��#��f,�྄_�i3pE�׀jڌ�|�m�M��P���ʂ��i3�Y��3���c���Na�I���*�٫
�$�'����u���X�̹�ր�ڌ�M;CG�&�>Ap��pb@Jm��-ͤ ���ڌ�+��431�$��
l�6�K��P8-��q@Rm�"�5Y�I��r	L���sM���GYNL{@Ym��M@zch��X�w(�`�W��S�Y6�y���@�k��
�FYƚ�z)1������D{)1�Pp��&�^JL�7m)���X�L�"�: ��A�T�۵0b
���̾����f,����k@omƢ�y9��)�'�gǁ��5��6cy�IU��k;�Af��K�k3n���y�)�����2�c�)��$����I��O�����$�K��:A���I��9Lh�&+X(0�
p�DY�B��{軌5����kk��*1�sӞ��
>����~�2�cܺx���x���|Q��N�f����e� �
V���B�	ꬽog*�	L&ȳ=V�I���3A�,��Ʉ�X�5��N�Y��4�5A�,Ύc1E��	�`y�0���$�;�i8sX(�8����9�B���L�i��7����cM�Gz\�g'���D��H��&�^.�s��!7�DZ��	��v�H�ce�͞�$��V�B��^�\�H���A�&�^>?<%��$���r�\2�Dk'����LgL���lO������NRiI.�s.�pu�J�X�*�k�FK��3�c�Ho�$�����U��j�����3;I�e,J�hIfk�#�/a�e���$�Kǟ�۲v�B�X���A�$����S?I�%����?e��Dy�����$ϒ4���<�$�Kq6e_"f~�<K��g��@�k�>��3��`'鳌�P������R���e�'���������=��\�۾����1�$q�M�q<>�W� öw�:5��E��>�^���Ag�S�@n]�8\X���aWGҗ�0;X>��+�佾j����quqz�M�2N)8`����k��:����#����o�n<��v}uUu�ˬ����ІKU\ƍm����qSwC��o �  ����HP.+�ȃ���L"�,)��`'c������{/���\f�.\\�o���L�"���W��B��d��^���da�~��{-��G��\I�������������ۅ�<&'�m�p�����V��2a~�� �#/�����9!�ޓRrF�����|^nI�p^S��񿖁䃿�:\7g��tx	d��v����~<?�c���|2�爀'yw?~��R*�)&���ԓ�=�I
66��B_�a�.�|���KƇ)�d^!ε�N�Xq��.��>{2���Œ��x�<���;;:o-�=Ev /_��e���]���P9:�!�;g%K�}/M�>��:0�9�;F�A7'mw�ç6�ݜcq�ܱ��JE�BUkpw���O'�5ch&�%�G�m��])�sk��~�����Y�kmL�C��V)���g�Uhe���8��,����r������b`�Lݏ�m�s����@�P��{ ��pd#^�^�ky�>+�Hx��<�zi�D�����t�HI�WgK��U�M�Y�CCo��ID��H�����A��Yn#U?��9=&���Jz����|]��q+H�V�K�q�B�"P�Ob
���/�?q��;$1�[ֿ����h^���^�~$�f�t�6J�P�"�����m�?���p�-z��6J��P��k�-%7Q��`�"'ǘln��f����f����.�/R��W@���{u��g� �q7�P�h�5���Hl�.I>�Xm�N���2�	9K�~My�C	�hr��OK��<�ע>�.�8k=����F
�?�}S$�����D8��箍l���Ɋ')�l���$�0
n
�����x(�S2�P�E�7liwb�e?�};�TF��l�%ӹ���0T�mp��^X|(�L�<|��e��;�1t��+��a��ϐ�^
w��������LF793��n+#y�6~E�B��8��L�3����J#�{�����5�0���<y�a'3v���Y��԰㬲�o#�[$W��+:Ϊ_C���R0H_�jVU����$q�[*-��K��ߟ�B����d�&94���~�"q2r:ݫ,#��w��D9��,��*s�F�b���Q��������*������b�;
E"� E����8��{$�i��FF;X���c�z��wC����E{ѣy(��,S���G�#K1�sD ��Z���BB�� ��Y�	"#�g5�$~�*"'@N��C��$��JJ���s�x\�p:"�ݸ=���m�1�m��|T��\IF7�c���u��-[���p}4CوbKn>�i^J&���[=�md��o�L��^��6��6��oإ��8�����Qv�A���5Fb����gt��tS��h�Å�����G����6;      �   �   x�m��
�@����S���쮺{�IJA�AD0����˅�|��>���ӵ$ȫ�oZ0�!;U�&�x�l�X���1��Yu�"��Z6#33Sn��ﯦ�.�TV�R"��휥�tk�����p��j��$�ѵ`��l�5#���&J+*=�ڵ\�S&]������
!���b�      �   �  x����j�F��k�S����hF�sm�Kq)Mm/T��jv�eצ�O_�Y�"#��1$W�:�+i��8���+>uǧ���PԪ��Wו���n�gw�+���������������C9������C�?l��m?>^�V��������S�+�(t��۪}[��r����B7��a���M��-��(W�x����v�wi]��?���^N�*���|�U��;��t���i�FN����SUe�Z=G��y�׾�����j�U箭QSR�\��|>�Ǯ�~{z9�Z�Ս�z�K���g�y�i�y��4sV��O1��f=5m�t+^7�5����ﶇ������{ʮoK<�!�s=�BUq��y���5���<���n]y9�k��/\��٨���D/P%�HW�='�
J��h>i'�%W1���PR�Иl�d%W1��4Pr�BKI%W	��l��ԟ1馤C�z�?KI%W鳔��ф>!� }4�OHB�hF����ь>!	�}��i��f�	IH����>��'$!}jF�����}Bҧf���ҧf�����>5�OHB�Ԍ>!	�S3��$�O����>5�OHB�Ԍ>!	�c}B�ǈ���>%!}�X�$�B��>i�ǈ�I��>F�O���1b}�$���&!}�X�!9���B��>i�Ǌ�I��>��'$!},�ϔTďe��M����@� Hա		d	��&D�%J��A�0(iBY!eBR�!J�C�P҄j�bSA5�CIr�!J��C�PlB5�C64!�ơ؄j�br�a�M�!�8��C�q(6!��Phj�!�8��C�q�	M�!�8��C�q(6!��PlB9ơ؄r�C�	9��br�3�Є�C�YCyơ؄�C�	9��br�3�&�g�M�!�8�Cr�3�&�P�8��C-�PlB��C�i �Zơ؄j�br�ejCr�e�Mȡ�q(6!�Zơ؄j�bqh|��5��Cj�fz��8��K�i�Ժ��|SW��8�����CJ��Λ�Cj�Tz��8��M���Cj�Nz��8��3�	9�n'�B3�_��C�fҋM�!�N:mBCi%JgM�!�R:kBɧ�YrH��Κ�C���ԡ	9$_KgM�!�\:kB���YrH>�Κ�C��tڄ&�J>�Κ�C��tք����f�����|5�5!���	9$�MgM�!�p:kBɗ�YrH>�Κ�C�������񴒏��&�|=�5!����	9$�OgM�!��:kB��YrH>���>/��V�uքbF�Ir�YQ�&4�V̌:iB1;�	9���&���N��C̔Z�{�ЖZ1[�	9Č��&���N��C̜:iB1{���ОZ1{�	9�쩵M�!fO�4!��=u҄b��Ir��S'M�!fO�4!��=u҄b��ڇf���6��D3�����ʫ�SDn����n�|K�|����l�����G�GP>k���z|s������@�Y>�_
����w���^�[_      �   �
  x���ͪ$���w�B/ S��Oeޝ��B�1b0��������o��
螊��]���_|����_����'������}�_���?~)/?����~{��������~���㯟����/��:��l�=��.�����z_m���^��4�B��T����~!K���2޲�{޳�x�-n�~�-��r��8v���{l=b{;���ܛ�����}��a��C�{�~<q�n��{�8�x"�h����h	C��9 q��2���������O_�v�54�c7;��ذ���ܭD?>�M����{��9������6�|��{wڎ�a�}-�ע��0X�X���3~g�ȴ�̣+�[O�ue}���2:��3�h�񀬆6�0a<c����ƃ���4�h�q>��i�AV��=�b���Y1�
�G�	��b������&�k3nwc�k��[8.L��l�ma�[1��[C|[ܣ��r��{m�í��a�c3��W��֮���p�ە���V���*-~tC�jա҂�X��Z��D��5�)ndK<��V�����qՈ�q3�� #�qu�6J ]5���{`�Uc���)�<�a����p�uͨk�m�5���eq�Ս�fԵ��3��t퀮%����Z�%~ڀk\;�c8��\3��[!�MN��mm\ĕ\3��\K���֍���Ը�h�u���-]���n��'��yc�s�1Kc�s�`n��*h�uc��Gl�hS�]Y�0�	������r��Z�n��q��îv}��9�$�q�w����/�n��n��%Ũۍ������ݨۍ���Hw�K�xX<�������6^�[c7|a���4Aa������4d_n��6C�������G�����z�i�S�֩��S��C�Q����? }_U�P���P#��Z�ڭC��C�~�:�n�j?:Ո����}�q|�w�j]jX�G��77�֥�u����X�.1�K�=J��a7�q�j��n8��Y�vð���7�nw�-Z�o���������tà~$O}�f�Mo��<�5������$|��؛��t�֙{�o|�\�ɛ�7���1>����<�K�Xь�i�������ߍ�i�M7��O~`�s\y��*�n����k�_n�R)T1�T2��~=5x�(�����Bb���%�%n��?@�c%n+8�w(fjt�h�� ,��8$nuKq Ys)T	�T
�\�(Q�n��wP��ѵ�Z+*��B"~	�e0׶�<�p�p����ay�Q�"խR�R8�*���K�,�tLbI�|�2�Ȥ���d��qR��#,+����2���3���b��3���3�sIi8O3� ej�TM���\$k�lS��l��͈'*I���i�=/%n��M��P�r7p�H�����A
i������&�H����óL�r�\�W>$r ��rj�!�ڿ�|y[�S�E)�KUv9H��Y��h�(�'v��;�فS;{�T���v����4!�w �'x2� 
ex�O\=��x��2�)�<���3�_��@����\C�:�*$�JR�)�)8��AP��>p�g�K_����������(��x��)��8�Sr� "%��ψ;�������͔���ϿP�@p(^�Q�@p"h���N��;N!�bQ>���rB���B-54HAfN�ԋHAnNŧc(9�!8=��e� E�zj��#�$��1R��Dp�(�5�� W'�b,� Y��h(�3��e�h�!��V��E�0�3F-�A%� k��R�sJA�N�U�A��e�Ť����� A
	�!1^:H A	���@�)�T�kAn��l�l���5(�)8璒�����:��L�Z2/�z�s/ɧ��/p���B`���)���ea ����y
�)'cR�J�@6^�ċ ���`<1��)�������:BJr2pR�o!)Y��g��։�u$w\��3���xR�<O!.%h�M\���h0/��$i�,͞��R�^��R�Ky8Q��%�Ddj�TM\��L�j�\M\w�Ddj0�6:O!"�j�d�L�"�5����;O�b_���i��"��5����5H<�N���й�La�R5���S51	25������{n�J�Щ���TJ�P��NԌ� ei(KCgiR��(KCY:K��(KCY:K�Բ^��5t�&W�����u���Lr5��!���'�J��ɚ�d>ej(SCgjf�%�L����ej(SC\�i(MC�iR_R��25t�fO!-YC�:Y��﮻4�2���c��4�B�35����U��ո{5����[�.�8_�����u��Wd6��u��ۚ�;��u��	��h�]�u��	��yq]�Y�m���S���t�n��k7) ek([�r�RƆ26tƦ�IJ��I��b ��n{��dj�#iCI�'����Rކ���M�Jݰ\���J�Щ�Ԧ���P���ޔLC��ް\,�	J��	�=�"�R�����$^PJ�����t�"�C	:��:�T�uq�Et21�E�8�W��"{C�:{���%p�Nn�)28���38���E��8t'֪E�28|v�<����a{��9O!*%q�L✧��8l~���"�C�:��ګ�K�����hE.�r9t.'V E"�9lO���X�ֱ7Vg����׃��~z������������?~��22:�_���3 ��L�����������?�{�����      �   +  x�����7�ϽO�ph�[��ޜ�	6�I ��䔷��<���gT��,��U��J�Rχ���;-i]���~����*�c^��vmo��f=��������P���_5~����u��l�����O�:�uI)ݎO�s��o�~ޖ���}�JK���(��h�0���y�~X|�)\'�-['�W�;\Jy�e{ �0������e_��'�w���e|����Kw�y�Q}�9���,�G��@�DQo���s����D��[3��@�"�-`Gw�[9Z��1+K�%���wk��<Gf�w�VB��	��{3@�l]WH~x3H@�旊$OkdZ����4/�4?� Qi�_-"}�1�׀�$ �^,�m��{	I@�!�Y� ��i���fQ!�yD���;"�6O�$
S��ӄH�& y
�Q y�v��x9H@��#�x�����/�:�P�q0�{���_�9�sݻ		��|�"Q�8�H�����(�:wE����W@Ε�_,"�t�����w
,�H'��l�$ z���2�<�����A��G�ѫ�D�懗r��wJ2y�����f��(N����H�x�3��G�`r7kuB�|N4��qāH�$:�ύ��6K���nT�ңy�B���6xI��oG`uI01�:�ف`	 .��I�`DX�{����D�(��� ��{� ޫ"Ȭ�3P����x�3Y�ics������,B��+4�tPS���E�m��BL7�������B�e�� �m[#2m�H���;r��m�����+&ԯ![��	!<�&�F��E������ �������1��Ne���:�� �VOG��(�A���ay�3� 5e��WO�M�;�)��ǲ 9e������]�ɼ�`��[/��K���/y��!��{���X&��W�c*�����?�@�-+��oCY����(2���`����wwa}�ޟ�26�|�Q�-o� ��Wd8� ��"Ĭ�;��կ1Kx��|��/���b�G��.`	����&YE�7{ቄ�@|Wdz�3"�����H�|�����@�%®��#v�ǟ:��n ����2����}@f�Њ�.�F��'�8����?c)��)�~���/�p��̓�~wҳ |��{� ӫ�a��s� ����5�3'8@�O���AB^���"�����@��w�J�ow��~�iY����r�������vrdx���/s�~6~C�Gb_�}c��?E^y��ߩ��;���,L
�qA�*��_�-˙���@�_����a��z�"��[������S�-��U�����l��$���_*h�(R�iY�X�G):�-���w-F$���8ee��ܫ�#b��	��IV~^A���^&H �+r�r#r�Ln��1a�o�eA���H��S$��SD��a�{�?�(�[_E���KA�~�3��)�d@���>��ן_��ay�����?N����R�p+��l/Xy�R�{�~�2��߿{zz�m��B      �     x�]�Mj%1��ݧ���ɽ�*Bf���@ ��E��K���y����gYO5mO��>�_���������|	mK[I��Ҽ%Hv�v��վ~��2��ek5��v�~�-���\ks��d�A��K1B�\����88_+�4��Y���l P+ P�A��m 0%4�ـ��M젃A��z(!���`�SvU�ve��; ,7� �����@��2@a��
Ub@ar%�@�4B%p-@� �7@�� $$<v.����(@`�ǀ��q&ׁA�;��߂���%b�!�@p���y7���=ԁ� �38�����<@�`0%T~�13{�`���f(�6���
A0h��oa���]���'=;ǵ�)��*0t�K"&H�F�+4GQ���H�1SΡ;���R�T
�A��7!w��)R葚+4�&R���GP����ze*�s*���(��������//?4r�|�q���,��5TĀ�}�]�����<�o�h������	r)>,      �   `   x�34�tw����7�4��41!##]K]s+C+CSN#3N���Ңļt.C#� �� �NSNc D�fdhelae`�id������ �5<      �   #   x���4620026�42�24�47� 2͸b���� Gx     