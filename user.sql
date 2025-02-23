PGDMP     2                    |            user    10.6    10.6                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                        0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            !           1262    17811    user    DATABASE     �   CREATE DATABASE "user" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE "user";
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            "           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    4                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            #           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1                        3079    17813    dblink 	   EXTENSION     :   CREATE EXTENSION IF NOT EXISTS dblink WITH SCHEMA public;
    DROP EXTENSION dblink;
                  false    4            $           0    0    EXTENSION dblink    COMMENT     _   COMMENT ON EXTENSION dblink IS 'connect to other PostgreSQL databases from within a database';
                       false    2            �            1259    17859    user    TABLE     n   CREATE TABLE public."user" (
    id_user bigint NOT NULL,
    nama text,
    nik text,
    department text
);
    DROP TABLE public."user";
       public         postgres    false    4            �            1259    17865    user_id_user_seq    SEQUENCE     y   CREATE SEQUENCE public.user_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.user_id_user_seq;
       public       postgres    false    4    198            %           0    0    user_id_user_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.user_id_user_seq OWNED BY public."user".id_user;
            public       postgres    false    199            �
           2604    17867    user id_user    DEFAULT     n   ALTER TABLE ONLY public."user" ALTER COLUMN id_user SET DEFAULT nextval('public.user_id_user_seq'::regclass);
 =   ALTER TABLE public."user" ALTER COLUMN id_user DROP DEFAULT;
       public       postgres    false    199    198                      0    17859    user 
   TABLE DATA               @   COPY public."user" (id_user, nama, nik, department) FROM stdin;
    public       postgres    false    198   �       &           0    0    user_id_user_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.user_id_user_seq', 50, true);
            public       postgres    false    199            �
           2606    17869    user user_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id_user);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public         postgres    false    198               ~  x�]�[s�0��׿¿�c�d.�I)	%��$���e{�
�_�$��k���WK>:�[)�*J��9e;�e�(��U�m!\w��W�ڪ��e�}^7����H�G����MK��@��U�Z�6��Y~���lj��o1����(�O[��t,1|O�@u^T]�G#��mh�S�#�w����pc[������8t7���elom�Л��p�����L%��V�x��oCv�x��,햓�9�5���]�-�ŷ���.�)��*f�%OF	x��C���n��T
�%����S#`�G��@n��Sc�Z�Ҿ��&�;_�W����ʶ��uT<?L�)�t��!@T����S�>���!|gU1]�Pú���֞2� �~�" ��)�T��*��2�����zc �p��8_`q�T�&�B��!����@OQ'0c���!E��C��0j�97��[�e�5�t�2D�Im��87E{�:�Ů�RNZ������wd"��zK�[���/P�	�Y:ƴ�W��sf@Q{�&��޺@`B�F�#W9Lo������FsU�8��G���k._A�	���`1C�3#x�YQ�3c�J{�O�3X��AA�Lᅆ��gh<�4�0��_���!��=��     