PGDMP     0                    |            modul    10.6    10.6                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                        0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            !           1262    17257    modul    DATABASE     �   CREATE DATABASE modul WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE modul;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            "           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    4                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            #           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1                        3079    17280    dblink 	   EXTENSION     :   CREATE EXTENSION IF NOT EXISTS dblink WITH SCHEMA public;
    DROP EXTENSION dblink;
                  false    4            $           0    0    EXTENSION dblink    COMMENT     _   COMMENT ON EXTENSION dblink IS 'connect to other PostgreSQL databases from within a database';
                       false    2            �            1259    17269    moduls    TABLE     U   CREATE TABLE public.moduls (
    id bigint NOT NULL,
    nama text,
    link text
);
    DROP TABLE public.moduls;
       public         postgres    false    4            �            1259    17275    modul_id_seq    SEQUENCE     u   CREATE SEQUENCE public.modul_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.modul_id_seq;
       public       postgres    false    4    197            %           0    0    modul_id_seq    SEQUENCE OWNED BY     >   ALTER SEQUENCE public.modul_id_seq OWNED BY public.moduls.id;
            public       postgres    false    198            �
           2604    17277 	   moduls id    DEFAULT     e   ALTER TABLE ONLY public.moduls ALTER COLUMN id SET DEFAULT nextval('public.modul_id_seq'::regclass);
 8   ALTER TABLE public.moduls ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    198    197                      0    17269    moduls 
   TABLE DATA               0   COPY public.moduls (id, nama, link) FROM stdin;
    public       postgres    false    197   W       &           0    0    modul_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.modul_id_seq', 2, true);
            public       postgres    false    198            �
           2606    17279    moduls modul_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.moduls
    ADD CONSTRAINT modul_pkey PRIMARY KEY (id);
 ;   ALTER TABLE ONLY public.moduls DROP CONSTRAINT modul_pkey;
       public         postgres    false    197               5   x�3����+�ȩTJ-�/*�̅p��\.#Nϼ�Լ���L�L�+F��� ~�m     